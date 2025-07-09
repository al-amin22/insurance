<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\InsuranceCategory; // Sesuaikan dengan model Category Anda
use Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share footerCategories dengan semua view
        View::composer('*', function ($view) {
            $footerCategories = InsuranceCategory::take(5)->get(); // Ambil 5 kategori atau sesuaikan
            $view->with('footerCategories', $footerCategories);
        });
    }
}
