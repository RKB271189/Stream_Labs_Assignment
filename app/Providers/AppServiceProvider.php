<?php

namespace App\Providers;

use App\Repository\Editor\EditorInterface;
use App\Repository\Editor\EditorRepository;
use App\Repository\Product\ProductInterface;
use App\Repository\Product\ProductRepository;
use App\Repository\Profile\ProfileInterface;
use App\Repository\Profile\ProfileRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(ProfileInterface::class, ProfileRepository::class);
        $this->app->bind(EditorInterface::class, EditorRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
