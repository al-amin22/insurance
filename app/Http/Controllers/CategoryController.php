<?php

namespace App\Http\Controllers;

use App\Models\InsuranceCategory;
use App\Models\InsuranceArticle;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($country, $slug)
    {
        $category = InsuranceCategory::where('slug', $slug)->firstOrFail();

        $articles = InsuranceArticle::where('category_id', $category->id)
            ->where('country', strtoupper($country))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $popularInCategory = InsuranceArticle::where('category_id', $category->id)
            ->where('country', strtoupper($country))
            ->orderBy('visit_count', 'desc')
            ->limit(5)
            ->get();

        $categories = InsuranceCategory::withCount(['articles' => function ($query) use ($country) {
            $query->where('country', strtoupper($country));
        }])
            ->orderBy('articles_count', 'desc')
            ->limit(8)
            ->get();

        return view('categories.category', compact('category', 'articles', 'country', 'popularInCategory', 'categories'));
    }

    public function index()
    {
        $footerCategories = InsuranceCategory::take(5)->get(); // Ambil 5 kategori (sesuaikan)

        return view('layouts.app', [
            'footerCategories' => $footerCategories,
        ]);
    }
}
