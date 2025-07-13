<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Models\InsuranceArticle;
use App\Models\InsuranceCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;


class SitemapController extends Controller
{

    public function index()
    {
        $articles = InsuranceArticle::with('category')
            ->orderBy('updated_at', 'desc')
            ->take(10000)
            ->get();

        $categories = InsuranceCategory::all();
        $countries = ['us', 'gb', 'ca', 'au', 'de', 'jp'];

        return response()->view('sitemap_index', compact('articles', 'categories', 'countries'))
            ->header('Content-Type', 'application/xml');
    }

    public function articles($page)
    {
        $perPage = 1000;

        $articles = InsuranceArticle::with('category')
            ->orderBy('updated_at', 'desc')
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        return response()->view('sitemap_articles', compact('articles'))
            ->header('Content-Type', 'application/xml');
    }
}
