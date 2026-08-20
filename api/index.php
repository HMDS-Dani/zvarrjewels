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

// Copy pre-discovered packages manifest to writable /tmp
$bundledPackages = __DIR__.'/../bootstrap/cache/packages.php';
if (file_exists($bundledPackages)) {
    @copy($bundledPackages, '/tmp/packages.php');
}

putenv('APP_PACKAGES_CACHE=/tmp/packages.php');
$_ENV['APP_PACKAGES_CACHE'] = '/tmp/packages.php';

// Redirect storage paths to /tmp
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';

putenv('SESSION_DRIVER=file');
$_ENV['SESSION_DRIVER'] = 'file';

putenv('CACHE_STORE=file');
$_ENV['CACHE_STORE'] = 'file';

// Ensure default fallback APP_KEY if environment variable wasn't injected by Vercel
if (! getenv('APP_KEY') && ! isset($_ENV['APP_KEY'])) {
    putenv('APP_KEY=base64:H9WwMWCk1nLWN1+8QKMeZ5JGzVpCALfVKzWM9myh33E=');
    $_ENV['APP_KEY'] = 'base64:H9WwMWCk1nLWN1+8QKMeZ5JGzVpCALfVKzWM9myh33E=';
}

// Database setup for serverless: if no external DB configured or localhost, fallback to SQLite
$dbHost = getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? '');
if (empty($dbHost) || in_array($dbHost, ['127.0.0.1', 'localhost', '::1'])) {
    $sqliteDb = '/tmp/database.sqlite';
    $bundledDb = __DIR__.'/../database/database.sqlite';
    if (! file_exists($sqliteDb)) {
        if (file_exists($bundledDb)) {
            @copy($bundledDb, $sqliteDb);
        } else {
            @touch($sqliteDb);
        }
    }
    putenv('DB_CONNECTION=sqlite');
    $_ENV['DB_CONNECTION'] = 'sqlite';
    putenv("DB_DATABASE={$sqliteDb}");
    $_ENV['DB_DATABASE'] = $sqliteDb;
}

try {
    // Forward all incoming Vercel Serverless requests to the Laravel public entrypoint
    require __DIR__.'/../public/index.php';
} catch (Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo "ZVARR Vercel Serverless Error Diagnostics:\n\n";
    echo 'Message: '.$e->getMessage()."\n";
    echo 'File: '.$e->getFile().':'.$e->getLine()."\n\n";
    echo "Stack Trace:\n".$e->getTraceAsString();
}
