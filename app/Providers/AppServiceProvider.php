<?php

namespace App\Providers;

use App\Models\Repositories\ITripRepository;
use App\Models\Repositories\TripRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app()->bind(ITripRepository::class, TripRepository::class);
    }
}
