<?php

namespace App\Providers;

use App\Repository\Editor\EditorInterface;
use App\Repository\Editor\EditorRepository;
use App\Repository\ListingRepository;
use App\Repository\ModelInterface;
use App\Repository\Product\ProductInterface;
use App\Repository\Product\ProductRepository;
use App\Repository\Profile\ProfileInterface;
use App\Repository\Profile\ProfileRepository;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        URL::forceScheme('https');
    }
}
