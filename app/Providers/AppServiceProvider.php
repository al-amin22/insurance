<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\InsuranceCategory;
use Illuminate\Support\Facades\View;

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
    public function boot()
    {
        // share 5 kategori teratas ke semua view yg menggunakan layouts.app
        View::composer('layouts.app', function ($view) {
            $footerCategories = InsuranceCategory::orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            $view->with('footerCategories', $footerCategories);
        });
    }
}
