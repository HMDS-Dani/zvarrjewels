<?php

// Prepare required writable directories in Vercel serverless /tmp partition
$storageDirs = [
    '/tmp/storage',
    '/tmp/storage/app',
    '/tmp/storage/app/public',
    '/tmp/storage/framework',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/logs',
];

foreach ($storageDirs as $dir) {
    if (! is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Ensure default fallback APP_KEY if environment variable wasn't injected by Vercel
if (! getenv('APP_KEY') && ! isset($_ENV['APP_KEY'])) {
    putenv('APP_KEY=base64:H9WwMWCk1nLWN1+8QKMeZ5JGzVpCALfVKzWM9myh33E=');
    $_ENV['APP_KEY'] = 'base64:H9WwMWCk1nLWN1+8QKMeZ5JGzVpCALfVKzWM9myh33E=';
}

try {
    // Forward all incoming Vercel Serverless requests to the Laravel public entrypoint
    require __DIR__.'/../public/index.php';
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo "ZVARR Vercel Serverless Error Diagnostics:\n\n";
    echo "Message: ".$e->getMessage()."\n";
    echo "File: ".$e->getFile().":".$e->getLine()."\n\n";
    echo "Stack Trace:\n".$e->getTraceAsString();
}

