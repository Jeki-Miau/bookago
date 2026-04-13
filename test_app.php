<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = \Illuminate\Http\Request::create('/search', 'GET', ['q' => 'Chris Oxlade']);
$response = $app->make(\Illuminate\Contracts\Http\Kernel::class)->handle($request);

echo "Status: " . $response->getStatusCode() . "\n";
file_put_contents('test_app.html', $response->getContent());
echo "DONE";
