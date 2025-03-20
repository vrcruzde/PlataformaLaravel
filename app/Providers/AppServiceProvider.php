<?php

namespace App\Providers;

use App\Models\Section;
use App\Observers\SectionObserver;

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
        //
        Section::observe(SectionObserver::class);
    }
}
