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
        $countries = ['us', 'gb', 'ca', 'au', 'de', 'jp'];
        $categories = InsuranceCategory::select('slug', 'updated_at')->get();
        $now = now()->toAtomString();

        $totalArticles = InsuranceArticle::count();
        $perPage = 1000;
        $totalPages = ceil($totalArticles / $perPage);

        return response()->view('sitemap_index', compact(
            'countries',
            'categories',
            'totalPages',
            'now'
        ))->header('Content-Type', 'application/xml');
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
