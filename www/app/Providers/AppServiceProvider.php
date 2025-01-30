<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Services\{AsetService, AsetServiceImplement, ExportPdfService, ExportPdfServiceImplement};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AsetService::class, AsetServiceImplement::class); // AsetService
        $this->app->bind(ExportPdfService::class, ExportPdfServiceImplement::class); // ExportPdfService
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();
    }
}
