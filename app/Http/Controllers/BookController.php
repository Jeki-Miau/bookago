<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BookController extends Controller
{
    protected BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of books.
     */
    public function index(Request $request): View
    {
        $selectedCategory = $request->input('category');
        $categories = ['Fiksi', 'Sains', 'Sejarah', 'Romantis', 'Biografi', 'Teknologi', 'Bisnis', 'Fantasi', 'Misteri'];
        // 1. Always get local database books first
        $localTrendingQuery = Book::withCount('categories')->orderByDesc('borrows')->take($selectedCategory ? 12 : 6);
        $localRecentQuery = Book::latest()->take($selectedCategory ? 12 : 6);

        if ($selectedCategory) {
            $localTrendingQuery->whereHas('categories', function($q) use($selectedCategory) {
                $q->where('name', 'LIKE', "%{$selectedCategory}%");
            });
            $localRecentQuery->whereHas('categories', function($q) use($selectedCategory) {
                $q->where('name', 'LIKE', "%{$selectedCategory}%");
            });
        }

        $localTrending = $localTrendingQuery->get();
        $localRecent = $localRecentQuery->get();

        // 2. Try to supplement with Google Books API
        if ($selectedCategory) {
            $queryParam = 'subject:' . $selectedCategory;
            $cacheKey = 'google_books_category_'.md5($selectedCategory);
            $maxResults = 12;
        } else {
            $idQueries = ['Pramoedya Ananta Toer', 'Andrea Hirata', 'Tere Liye novel', 'Dee Lestari', 'Habiburrahman El Shirazy'];
            $pickedQuery = $idQueries[array_rand($idQueries)];
            $queryParam = $pickedQuery;
            $cacheKey = 'google_books_id_'.md5($pickedQuery);
            $maxResults = 12;
        }

        $googleBooks = Cache::remember($cacheKey, 3600, function () use ($queryParam, $maxResults) {
            try {
                $response = Http::timeout(5)
                    ->withoutVerifying()
                    ->get('https://www.googleapis.com/books/v1/volumes', [
                        'q' => $queryParam,
                        'langRestrict' => 'id',
                        'orderBy' => 'relevance',
                        'maxResults' => $maxResults,
                        'key' => config('services.google_books.key'),
                    ]);

                if ($response->successful() && isset($response->json()['items'])) {
                    return collect($response->json()['items'])->map(function ($item, $index) {
                        $info = $item['volumeInfo'] ?? [];
                        $title = $info['title'] ?? 'Judul Tidak Diketahui';
                        $slug = Str::slug($title).'-api-'.$index;

                        // Cache the full book data for detail page
                        $bookCacheData = [
                            'title' => $title,
                            'authors' => $info['authors'] ?? ['Tidak Diketahui'],
                            'description' => $info['description'] ?? '',
                            'publisher' => $info['publisher'] ?? '',
                            'publishedDate' => $info['publishedDate'] ?? '',
                            'pageCount' => $info['pageCount'] ?? 0,
                            'categories' => $info['categories'] ?? [],
                            'averageRating' => $info['averageRating'] ?? null,
                            'ratingsCount' => $info['ratingsCount'] ?? 0,
                            'imageLinks' => $info['imageLinks'] ?? [],
                            'previewLink' => $info['previewLink'] ?? null,
                            'infoLink' => $info['infoLink'] ?? null,
                            'canonicalVolumeLink' => $info['canonicalVolumeLink'] ?? null,
                            'industryIdentifiers' => $info['industryIdentifiers'] ?? [],
                        ];
                        Cache::put('book_detail_'.md5($slug), $bookCacheData, 3600);

                        $book = new Book([
                            'title' => $title,
                            'author' => isset($info['authors']) ? implode(', ', $info['authors']) : 'Penulis Tidak Diketahui',
                            'slug' => $slug,
                            'cover_image' => isset($info['imageLinks']['thumbnail'])
                                ? str_replace('http://', 'https://', $info['imageLinks']['thumbnail'])
                                : null,
                            'preview_url' => $info['previewLink'] ?? null,
                        ]);

                        return $book;
                    });
                }
            } catch (\Exception $e) {
                // Silently fallback
            }

            return collect();
        });

        // 3. Google API books shown first (they have covers), local DB fills remaining slots
        if ($googleBooks->isNotEmpty()) {
            if ($selectedCategory) {
                 $trending = $googleBooks->merge($localTrending)->unique('title')->take(12);
                 $recent = collect(); // If category selected, we just show one grid of 12 books
            } else {
                 $trending = $googleBooks->take(6)->merge($localTrending)->unique('title')->take(6);
                 $recent = $googleBooks->skip(6)->take(6)->values()->merge($localRecent)->unique('title')->take(6);
            }
        } else {
            $trending = $localTrending;
            $recent = $localRecent;
        }

        return view('books.index', compact('trending', 'recent', 'categories', 'selectedCategory'));
    }

    /**
     * Display search results from local DB + Google Books API.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (! $query) {
            return redirect()->route('landing');
        }

        // 1. Search local database first
        $localResults = Book::where('title', 'LIKE', "%{$query}%")
            ->orWhere('author', 'LIKE', "%{$query}%")
            ->orWhere('isbn', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orWhereHas('categories', function($q) use($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->take(12)
            ->get();

        // 2. Also search Google Books API with multiple strategies (General, Author, and Subject)
        $apiResults = collect();
        try {
            // Take the first author name if there are multiple separated by commas
            $firstAuthor = trim(explode(',', $query)[0]);

            $responses = Http::pool(fn (\Illuminate\Http\Client\Pool $pool) => [
                $pool->timeout(5)->withoutVerifying()->get('https://www.googleapis.com/books/v1/volumes', [
                    'q' => $query,
                    'orderBy' => 'relevance',
                    'maxResults' => 12,
                    'key' => config('services.google_books.key'),
                ]),
                $pool->timeout(5)->withoutVerifying()->get('https://www.googleapis.com/books/v1/volumes', [
                    'q' => 'inauthor:"' . $firstAuthor . '"',
                    'orderBy' => 'relevance',
                    'maxResults' => 12,
                    'key' => config('services.google_books.key'),
                ]),
                $pool->timeout(5)->withoutVerifying()->get('https://www.googleapis.com/books/v1/volumes', [
                    'q' => 'subject:"' . $query . '"',
                    'orderBy' => 'relevance',
                    'maxResults' => 6,
                    'key' => config('services.google_books.key'),
                ])
            ]);

            foreach ($responses as $response) {
                if ($response instanceof \Illuminate\Http\Client\Response && $response->successful() && isset($response->json()['items'])) {
                    $items = collect($response->json()['items'])->map(function ($item, $index) use ($query) {
                        $info = $item['volumeInfo'] ?? [];
                        $title = $info['title'] ?? 'Judul Tidak Diketahui';

                        return new Book([
                            'title' => $title,
                            'author' => isset($info['authors']) ? implode(', ', $info['authors']) : 'Penulis Tidak Diketahui',
                            'slug' => Str::slug($title).'-api-'.md5($title.$index),
                            'cover_image' => isset($info['imageLinks']['thumbnail'])
                                ? str_replace('http://', 'https://', $info['imageLinks']['thumbnail'])
                                : 'https://ui-avatars.com/api/?name='.urlencode($title).'&background=f8fafc&color=0f172a&size=400',
                            'preview_url' => $info['previewLink'] ?? null,
                        ]);
                    });
                    $apiResults = $apiResults->merge($items);
                }
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Google API Search Pool Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
        }

        // 3. Merge: local results shown first, then API results
        $results = $localResults->concat($apiResults)->unique('title');

        return view('books.search', compact('results', 'query'));
    }

    /**
     * Display the specified book reading interface.
     */
    public function read(Book $book): View
    {
        return view('books.read', compact('book'));
    }

    /**
     * Display detailed book information from API.
     */
    public function detail(Request $request): View
    {
        $slug = $request->slug;

        // Try to get from cache first (cached when showing book list)
        $cacheKey = 'book_detail_'.md5($slug);
        $bookData = Cache::get($cacheKey);

        // If not cached, fetch from API using multiple search strategies
        if (! $bookData) {
            // Extract title from slug - handle multiple formats
            $title = str_replace(['-api-', '-'], [' ', ' '], $slug);
            $title = ucwords($title);

            $searchQueries = [
                'intitle:'.$title,
                $title,
                'inauthor:'.explode(' ', $title)[0].' '.$title,
            ];

            foreach ($searchQueries as $query) {
                try {
                    $response = Http::timeout(8)
                        ->withoutVerifying()
                        ->get('https://www.googleapis.com/books/v1/volumes', [
                            'q' => $query,
                            'maxResults' => 5,
                            'printType' => 'books',
                            'key' => config('services.google_books.key'),
                        ]);

                    if ($response->successful() && isset($response->json()['items'])) {
                        $items = $response->json()['items'];

                        // Find best match
                        foreach ($items as $item) {
                            $info = $item['volumeInfo'] ?? [];
                            $itemTitle = strtolower($info['title'] ?? '');
                            $searchTitle = strtolower($title);

                            // Check if title matches reasonably well
                            if (str_contains($itemTitle, $searchTitle) || str_contains($searchTitle, $itemTitle)) {
                                $bookData = $this->formatBookData($info, $info['title'] ?? $title);
                                break;
                            }
                        }

                        // If no good match, use first result
                        if (! $bookData && ! empty($items)) {
                            $bookData = $this->formatBookData($items[0]['volumeInfo'] ?? [], $items[0]['volumeInfo']['title'] ?? $title);
                        }

                        if ($bookData) {
                            // Cache for 1 hour
                            Cache::put($cacheKey, $bookData, 3600);
                            break;
                        }
                    }
                } catch (\Exception $e) {
                    continue;
                }
            }
        }

        // Fallback if nothing found
        if (! $bookData) {
            $title = str_replace(['-api-', '-'], [' ', ' '], $slug);
            $title = ucwords($title);
            $bookData = [
                'title' => $title,
                'authors' => ['Tidak Diketahui'],
                'description' => 'Maaf, detail buku tidak dapat dimuat. Silakan coba lagi atau cari buku lain.',
                'publisher' => '',
                'publishedDate' => '',
                'pageCount' => 0,
                'categories' => [],
                'averageRating' => null,
                'ratingsCount' => 0,
                'imageLinks' => ['thumbnail' => 'https://ui-avatars.com/api/?name='.urlencode($title).'&background=f8fafc&color=0f172a&size=400'],
                'previewLink' => null,
                'infoLink' => null,
                'canonicalVolumeLink' => null,
                'industryIdentifiers' => [],
            ];
        }

        return view('books.detail', compact('bookData', 'slug'));
    }

    private function formatBookData(array $info, string $fallbackTitle): array
    {
        $thumbnail = $info['imageLinks']['thumbnail'] ?? '';
        $thumbnail = str_replace('http://', 'https://', $thumbnail);
        $large = str_replace('thumbnail', 'large', $thumbnail);

        return [
            'title' => $info['title'] ?? $fallbackTitle,
            'authors' => $info['authors'] ?? ['Tidak Diketahui'],
            'description' => $info['description'] ?? 'Deskripsi tidak tersedia untuk buku ini.',
            'publisher' => $info['publisher'] ?? '',
            'publishedDate' => $info['publishedDate'] ?? '',
            'pageCount' => $info['pageCount'] ?? 0,
            'categories' => $info['categories'] ?? [],
            'averageRating' => $info['averageRating'] ?? null,
            'ratingsCount' => $info['ratingsCount'] ?? 0,
            'imageLinks' => [
                'thumbnail' => $thumbnail ?: 'https://ui-avatars.com/api/?name='.urlencode($fallbackTitle).'&background=f8fafc&color=0f172a&size=400',
                'large' => $large ?: $thumbnail,
            ],
            'previewLink' => $info['previewLink'] ?? null,
            'infoLink' => $info['infoLink'] ?? null,
            'canonicalVolumeLink' => $info['canonicalVolumeLink'] ?? null,
            'industryIdentifiers' => $info['industryIdentifiers'] ?? [],
        ];
    }
}
