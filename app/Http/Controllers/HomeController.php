<?php

// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use App\Models\InsuranceArticle;
use App\Models\InsuranceCategory;

class HomeController extends Controller
{
    public function index()
    {
        $popularArticles = InsuranceArticle::with('category')
            ->orderBy('visit_count', 'desc')
            ->limit(6)
            ->get();

        $categories = InsuranceCategory::withCount('articles')
            ->orderBy('visit_count', 'desc')
            ->limit(12)
            ->get();

        return view('home', compact('popularArticles', 'categories'));
    }
}
