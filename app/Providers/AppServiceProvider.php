<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'production')) {
            $this->app->useStoragePath('/tmp/storage');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production') || isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        // Share live store contact & social media settings across all shop storefront views
        View::composer('shop.*', function ($view) {
            $settings = [];
            try {
                if (Schema::hasTable('settings')) {
                    $settings = Setting::getAll();
                }
            } catch (\Throwable $e) {
                $settings = [];
            }
            $view->with('storeSettings', $settings);
        });
    }
}
