<?php

// Prepare required writable directories in Vercel serverless /tmp partition
$storageDirs = [
    '/tmp/storage',
    '/tmp/storage/app',
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

try {
    // Forward all incoming Vercel Serverless requests to the Laravel public entrypoint
    require __DIR__.'/../public/index.php';
} catch (Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain');
    echo 'ZVARR Vercel Error: '.$e->getMessage()."\nFile: ".$e->getFile().':'.$e->getLine()."\n\nTrace:\n".$e->getTraceAsString();
}
