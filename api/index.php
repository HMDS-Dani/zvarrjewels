<?php

// Prepare required writable directories in Vercel serverless /tmp partition
$storageDirs = [
    '/tmp/storage',
    '/tmp/storage/app',
    '/tmp/storage/app/public',
    '/tmp/storage/bootstrap',
    '/tmp/storage/bootstrap/cache',
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

// Copy bootstrap files to writable /tmp
if (file_exists(__DIR__.'/../bootstrap/providers.php')) {
    @copy(__DIR__.'/../bootstrap/providers.php', '/tmp/storage/bootstrap/providers.php');
}
if (file_exists(__DIR__.'/../bootstrap/cache/packages.php')) {
    @copy(__DIR__.'/../bootstrap/cache/packages.php', '/tmp/storage/bootstrap/cache/packages.php');
}

// Redirect storage paths to /tmp
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';

putenv('SESSION_DRIVER=database');
$_ENV['SESSION_DRIVER'] = 'database';

putenv('SESSION_LIFETIME=120');
$_ENV['SESSION_LIFETIME'] = '120';

putenv('SESSION_SECURE_COOKIE=true');
$_ENV['SESSION_SECURE_COOKIE'] = 'true';

putenv('SESSION_SAME_SITE=lax');
$_ENV['SESSION_SAME_SITE'] = 'lax';

putenv('CACHE_STORE=file');
$_ENV['CACHE_STORE'] = 'file';

putenv('BCRYPT_ROUNDS=12');
$_ENV['BCRYPT_ROUNDS'] = '12';

putenv('APP_MAINTENANCE_DRIVER=file');
$_ENV['APP_MAINTENANCE_DRIVER'] = 'file';

// Ensure default fallback APP_KEY if environment variable wasn't injected by Vercel
if (! getenv('APP_KEY') && ! isset($_ENV['APP_KEY'])) {
    putenv('APP_KEY=base64:H9WwMWCk1nLWN1+8QKMeZ5JGzVpCALfVKzWM9myh33E=');
    $_ENV['APP_KEY'] = 'base64:H9WwMWCk1nLWN1+8QKMeZ5JGzVpCALfVKzWM9myh33E=';
}

// Database setup for serverless: Support DATABASE_URL (Neon, Supabase, TiDB, MySQL, PostgreSQL)
$databaseUrl = getenv('DATABASE_URL') ?: ($_ENV['DATABASE_URL'] ?? '');
if (! empty($databaseUrl)) {
    $parsed = parse_url($databaseUrl);
    if ($parsed) {
        $scheme = $parsed['scheme'] ?? '';
        if (str_contains($scheme, 'postgres') || str_contains($scheme, 'pgsql')) {
            putenv('DB_CONNECTION=pgsql');
            $_ENV['DB_CONNECTION'] = 'pgsql';
            putenv('DB_PORT='.($parsed['port'] ?? 5432));
            $_ENV['DB_PORT'] = $parsed['port'] ?? 5432;
        } elseif (str_contains($scheme, 'mysql')) {
            putenv('DB_CONNECTION=mysql');
            $_ENV['DB_CONNECTION'] = 'mysql';
            putenv('DB_PORT='.($parsed['port'] ?? 3306));
            $_ENV['DB_PORT'] = $parsed['port'] ?? 3306;
        }
        putenv('DB_HOST='.($parsed['host'] ?? ''));
        $_ENV['DB_HOST'] = $parsed['host'] ?? '';
        putenv('DB_USERNAME='.($parsed['user'] ?? ''));
        $_ENV['DB_USERNAME'] = $parsed['user'] ?? '';
        putenv('DB_PASSWORD='.($parsed['pass'] ?? ''));
        $_ENV['DB_PASSWORD'] = $parsed['pass'] ?? '';
        $dbName = ltrim($parsed['path'] ?? '', '/');
        if (empty($dbName) || $dbName === 'sys') {
            $dbName = 'test';
        }
        putenv('DB_DATABASE='.$dbName);
        $_ENV['DB_DATABASE'] = $dbName;
        putenv('MYSQL_ATTR_SSL_CA=true');
        $_ENV['MYSQL_ATTR_SSL_CA'] = 'true';
        putenv('MYSQL_ATTR_SSL_VERIFY_SERVER_CERT=false');
        $_ENV['MYSQL_ATTR_SSL_VERIFY_SERVER_CERT'] = 'false';
    }
}

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
