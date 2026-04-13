<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    // Rotating queries focused on Indonesian authors/titles
    $queries = ['Pramoedya Ananta Toer', 'Tere Liye', 'Andrea Hirata Laskar', 'Dee Lestari Supernova', 'Pidi Baiq Dilan', 'Ahmad Fuadi Negeri'];
    $randomQuery = $queries[array_rand($queries)];

    // Fetch data from Google Books API, caching for 1 hour (3600 seconds)
    $recommendedBooks = Cache::remember('google_books_id_landing_'.Str::slug($randomQuery), 3600, function () use ($randomQuery) {
        try {
            $response = Http::timeout(5)
                ->withoutVerifying()
                ->get('https://www.googleapis.com/books/v1/volumes', [
                    'q' => $randomQuery,
                    'langRestrict' => 'id',
                    'orderBy' => 'relevance',
                    'maxResults' => 12,
                    'key' => config('services.google_books.key'),
                ]);

            if ($response->successful() && isset($response->json()['items'])) {
                return collect($response->json()['items'])->map(function ($item) {
                    $info = $item['volumeInfo'] ?? [];

                    return [
                        'title' => $info['title'] ?? 'Judul Tidak Diketahui',
                        'author' => isset($info['authors']) ? implode(', ', $info['authors']) : 'Penulis Tidak Diketahui',
                        'cover' => $info['imageLinks']['thumbnail'] ?? 'https://ui-avatars.com/api/?name='.urlencode($info['title'] ?? 'Buku').'&background=f8fafc&color=0f172a&size=400',
                    ];
                });
            }
        } catch (Exception $e) {
            // Silently fail if API is down
        }

        // STATIC FALLBACK: If API fails or rate limit hit, return these so the carousel NEVER breaks.
        return collect([
            ['title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'cover' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=400&auto=format&fit=crop', 'preview_url' => null],
            ['title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'cover' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?q=80&w=400&auto=format&fit=crop', 'preview_url' => null],
            ['title' => 'Negeri 5 Menara', 'author' => 'A. Fuadi', 'cover' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?q=80&w=400&auto=format&fit=crop', 'preview_url' => null],
            ['title' => 'Dilan', 'author' => 'Pidi Baiq', 'cover' => 'https://images.unsplash.com/photo-1511108690759-009324a50344?q=80&w=400&auto=format&fit=crop', 'preview_url' => null],
            ['title' => 'Perahu Kertas', 'author' => 'Dee Lestari', 'cover' => 'https://images.unsplash.com/photo-1476275466078-4007374efac4?q=80&w=400&auto=format&fit=crop', 'preview_url' => null],
            ['title' => 'Ayat-Ayat Cinta', 'author' => 'Habiburrahman El Shirazy', 'cover' => 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?q=80&w=400&auto=format&fit=crop', 'preview_url' => null],
        ]);
    });

    return view('welcome', ['recommendedBooks' => $recommendedBooks]);
})->name('landing');

Route::get('/catalog', [BookController::class, 'index'])->name('home');
Route::get('/search', [BookController::class, 'search'])->name('search');
Route::get('/saved', function () {
    return view('books.saved');
})->name('books.saved')->middleware('auth');
Route::get('/read/{book:slug}', [BookController::class, 'read'])->name('books.read');
Route::get('/book/{slug}', [BookController::class, 'detail'])->name('books.detail');

// Forum Routes
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::get('/forum/baru', [ForumController::class, 'create'])->name('forum.create')->middleware('auth');
Route::post('/forum', [ForumController::class, 'store'])->name('forum.store')->middleware('auth');
Route::get('/forum/{slug}', [ForumController::class, 'show'])->name('forum.show');
Route::get('/forum/{slug}/edit', [ForumController::class, 'edit'])->name('forum.edit')->middleware('auth');
Route::put('/forum/{slug}', [ForumController::class, 'update'])->name('forum.update')->middleware('auth');
Route::delete('/forum/{slug}', [ForumController::class, 'destroy'])->name('forum.destroy')->middleware('auth');
Route::post('/forum/{slug}/reply', [ForumController::class, 'storeReply'])->name('forum.reply.store')->middleware('auth');
Route::put('/forum/reply/{id}', [ForumController::class, 'updateReply'])->name('forum.reply.update')->middleware('auth');
Route::delete('/forum/reply/{id}', [ForumController::class, 'destroyReply'])->name('forum.reply.destroy')->middleware('auth');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Socialite Google
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/contact-admin', [ContactController::class, 'showForm'])->name('contact.admin');
    Route::post('/contact-admin', [ContactController::class, 'sendMessage'])->name('contact.admin.send');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/announcements', [AdminController::class, 'announcements'])->name('admin.announcements');
    Route::get('/admin/announcements/create', [AdminController::class, 'createAnnouncement'])->name('admin.announcements.create');
    Route::post('/admin/announcements', [AdminController::class, 'storeAnnouncement'])->name('admin.announcements.store');
    Route::get('/admin/announcements/{announcement}/edit', [AdminController::class, 'editAnnouncement'])->name('admin.announcements.edit');
    Route::put('/admin/announcements/{announcement}', [AdminController::class, 'updateAnnouncement'])->name('admin.announcements.update');
    Route::patch('/admin/announcements/{announcement}/toggle', [AdminController::class, 'toggleAnnouncement'])->name('admin.announcements.toggle');
    Route::delete('/admin/announcements/{announcement}', [AdminController::class, 'destroyAnnouncement'])->name('admin.announcements.destroy');

    Route::get('/admin/messages', [AdminController::class, 'messages'])->name('admin.messages');
    Route::delete('/admin/messages/clear', [AdminController::class, 'clearAllMessages'])->name('admin.messages.clear');
    Route::get('/admin/messages/{message}', [AdminController::class, 'showMessage'])->name('admin.messages.show');
    Route::post('/admin/messages/{message}/reply', [AdminController::class, 'replyMessage'])->name('admin.messages.reply');

    Route::get('/admin/warnings', [AdminController::class, 'warnings'])->name('admin.warnings');
    Route::get('/admin/warnings/create', [AdminController::class, 'createWarning'])->name('admin.warnings.create');
    Route::post('/admin/warnings', [AdminController::class, 'storeWarning'])->name('admin.warnings.store');
    Route::patch('/admin/warnings/{warning}/toggle', [AdminController::class, 'toggleWarning'])->name('admin.warnings.toggle');
    Route::delete('/admin/warnings/{warning}', [AdminController::class, 'destroyWarning'])->name('admin.warnings.destroy');

    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');

    Route::get('/admin/discussions', [AdminController::class, 'discussions'])->name('admin.discussions');
    Route::delete('/admin/discussions/{discussion}', [AdminController::class, 'destroyDiscussion'])->name('admin.discussions.destroy');
    Route::delete('/admin/replies/{reply}', [AdminController::class, 'destroyReply'])->name('admin.replies.destroy');
});
