<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            if (class_exists(\Laravel\Pail\PailServiceProvider::class)) {
                $this->app->register(\Laravel\Pail\PailServiceProvider::class);
            }
            if (class_exists(\Laravel\Pao\Laravel\ServiceProvider::class)) {
                $this->app->register(\Laravel\Pao\Laravel\ServiceProvider::class);
            }
            if (class_exists(\NunoMaduro\Collision\Adapters\Laravel\CollisionServiceProvider::class)) {
                $this->app->register(\NunoMaduro\Collision\Adapters\Laravel\CollisionServiceProvider::class);
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 本番で public/hot を誤参照しないよう、環境ごとに hot ファイル参照先を固定する
        Vite::useHotFile(
            $this->app->environment('local')
                ? public_path('hot')
                : storage_path('framework/vite.hot')
        );

        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
