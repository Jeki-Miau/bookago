<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$query = "Chris Oxlade";
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

foreach ($responses as $i => $response) {
    if ($response instanceof \Illuminate\Http\Client\Response) {
        echo "Response $i status: " . $response->status() . "\n";
    } else {
        echo "Response $i error: " . get_class($response) . "\n";
    }
}
