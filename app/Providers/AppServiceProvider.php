<?php

namespace App\Providers;

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
        //kategory share
        view()->composer('*', function ($view) {
            $categories = \App\Models\Category::where('status', 'active')->orderBy('order', 'ASC')->get();
            $view->with('categories', $categories);
        });
    }
}
