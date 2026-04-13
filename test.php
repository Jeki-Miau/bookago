<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$response = \Illuminate\Support\Facades\Http::withoutVerifying()->get('https://www.googleapis.com/books/v1/volumes', ['q'=>'Chris Oxlade', 'key'=>config('services.google_books.key')]);
file_put_contents('storage/logs/tinker.log', print_r($response->json(), true));
echo 'DONE';
