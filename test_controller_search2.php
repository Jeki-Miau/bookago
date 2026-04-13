<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$apiResults = collect();
$items = collect([new \App\Models\Book(['title' => 'test1'])]);
$apiResults = $apiResults->merge($items);
echo "After first merge: " . count($apiResults) . "\n";

$items2 = collect([new \App\Models\Book(['title' => 'test2'])]);
$apiResults = $apiResults->merge($items2);
echo "After second merge: " . count($apiResults) . "\n";

$query = "Chris Oxlade";
$firstAuthor = trim(explode(',', $query)[0]);
$responses = \Illuminate\Support\Facades\Http::pool(fn (\Illuminate\Http\Client\Pool $pool) => [
    $pool->timeout(5)->withoutVerifying()->get('https://www.googleapis.com/books/v1/volumes', [
        'q' => $query,
        'orderBy' => 'relevance',
        'maxResults' => 12,
        'key' => config('services.google_books.key'),
    ])
]);
foreach ($responses as $response) {
    if ($response instanceof \Illuminate\Http\Client\Response && $response->successful() && isset($response->json()['items'])) {
        $itemsAPI = collect($response->json()['items'])->map(function ($item) { return new \App\Models\Book(['title' => 'hi']); });
        $apiResults = $apiResults->merge($itemsAPI);
        echo "Items count from API: " . $itemsAPI->count() . "\n";
    }
}

echo "Total after API: " . $apiResults->count() . "\n";
$unique = $apiResults->unique('title');
echo "Unique count: " . $unique->count() . "\n";
