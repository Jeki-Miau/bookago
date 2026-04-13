<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$query = "Chris Oxlade";
$localResults = \App\Models\Book::where('title', 'LIKE', "%{$query}%")->take(12)->get();
$apiResults = collect();
try {
    $firstAuthor = trim(explode(',', $query)[0]);
    $responses = \Illuminate\Support\Facades\Http::pool(fn (\Illuminate\Http\Client\Pool $pool) => [
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
                return new \App\Models\Book([
                    'title' => $title,
                    'author' => isset($info['authors']) ? implode(', ', $info['authors']) : 'Penulis Tidak Diketahui',
                ]);
            });
            $apiResults = $apiResults->merge($items);
        }
    }
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}

$results = $localResults->merge($apiResults)->unique('title');
echo "Total results: " . $results->count() . "\n";
