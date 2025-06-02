<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\DrugRepository;
use App\Repositories\PharmacyRepository;
use App\Services\DrugService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(DrugRepository::class, fn() => new DrugRepository());
        $this->app->singleton(PharmacyRepository::class, fn() => new PharmacyRepository());
        $this->app->singleton(DrugService::class, fn() => new DrugService());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
