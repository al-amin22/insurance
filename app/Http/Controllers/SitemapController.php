<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\InsuranceArticle;
use App\Models\InsuranceCategory;

class SitemapController extends Controller
{
    public function index()
    {
        $xml = $this->generateSitemapIndex();
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function articles($page)
    {
        $perPage = 1000;

        $articles = InsuranceArticle::with('category')
            ->orderBy('updated_at', 'desc')
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($articles as $article) {
            if (!$article->category || !$article->country || !$article->slug) continue;

            $url = url($article->country . '/' . $article->category->slug . '/' . $article->slug);
            $lastmod = Carbon::parse($article->updated_at)->toAtomString();

            $xml .= "  <url>\n";
            $xml .= "    <loc>$url</loc>\n";
            $xml .= "    <lastmod>$lastmod</lastmod>\n";
            $xml .= "    <changefreq>monthly</changefreq>\n";
            $xml .= "    <priority>0.6</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function generateAndSave()
    {
        $xml = $this->generateSitemapIndex();
        File::put(public_path('sitemap.xml'), $xml);
        return response()->json(['message' => '✅ sitemap.xml disimpan di public/sitemap.xml']);
    }

    private function getValidCountries(): array
    {
        return ['us', 'gb', 'ca', 'au', 'de', 'jp'];
    }

    private function generateSitemapIndex(): string
    {
        $countries = $this->getValidCountries();
        $now = Carbon::now()->toAtomString();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Static Pages
        $staticPages = [
            url('/'),
            url('/about'),
            url('/contact'),
            url('/policies/privacy'),
            url('/policies/terms'),
            url('/policies/licensing'),
            url('/policies/dmca'),
        ];
        foreach ($staticPages as $url) {
            $xml .= "  <sitemap>\n";
            $xml .= "    <loc>$url</loc>\n";
            $xml .= "    <lastmod>$now</lastmod>\n";
            $xml .= "  </sitemap>\n";
        }

        // Country Pages
        foreach ($countries as $country) {
            $url = url("/$country");
            $xml .= "  <sitemap>\n";
            $xml .= "    <loc>$url</loc>\n";
            $xml .= "    <lastmod>$now</lastmod>\n";
            $xml .= "  </sitemap>\n";
        }

        // Category Pages per Country
        $categories = InsuranceCategory::select('slug', 'updated_at')->get();
        foreach ($countries as $country) {
            foreach ($categories as $category) {
                $url = url("/$country/category/{$category->slug}");
                $lastmod = Carbon::parse($category->updated_at ?? now())->toAtomString();
                $xml .= "  <sitemap>\n";
                $xml .= "    <loc>$url</loc>\n";
                $xml .= "    <lastmod>$lastmod</lastmod>\n";
                $xml .= "  </sitemap>\n";
            }
        }

        // Artikel sitemap per batch
        $totalArticles = InsuranceArticle::count();
        $perPage = 1000;
        $totalPages = ceil($totalArticles / $perPage);
        for ($i = 1; $i <= $totalPages; $i++) {
            $url = url("/sitemap-articles-$i.xml");
            $lastArticle = InsuranceArticle::orderBy('updated_at', 'desc')
                ->skip(($i - 1) * $perPage)
                ->take(1)
                ->first();
            $lastmod = $lastArticle ? Carbon::parse($lastArticle->updated_at)->toAtomString() : $now;

            $xml .= "  <sitemap>\n";
            $xml .= "    <loc>$url</loc>\n";
            $xml .= "    <lastmod>$lastmod</lastmod>\n";
            $xml .= "  </sitemap>\n";
        }

        $xml .= '</sitemapindex>';
        return $xml;
    }
}
