<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$query = "Chris Oxlade";
$firstAuthor = trim(explode(',', $query)[0]);
try {
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
        ])
    ]);

    echo "Responses count: " . count($responses) . "\n";
    foreach ($responses as $response) {
        if ($response instanceof \Illuminate\Http\Client\Response && $response->successful() && isset($response->json()['items'])) {
            echo "Items found: " . count($response->json()['items']) . "\n";
        } else {
            echo "Invalid response or error\n";
            var_dump(get_class($response));
        }
    }
} catch (\Exception $e) {
    echo "Exception occurred: " . $e->getMessage() . "\n";
}
