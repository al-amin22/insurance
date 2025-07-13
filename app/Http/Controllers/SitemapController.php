<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Models\InsuranceArticle;
use App\Models\InsuranceCategory;
use Illuminate\Http\JsonResponse;


class SitemapController extends Controller
{
    public function index(): Response
    {
        $xml = $this->generateSitemapIndex();
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function articles($page): Response
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
            if (!$article->category || !$article->slug || !$article->country) continue;

            $url = url("{$article->country}/{$article->category->slug}/{$article->slug}");
            $lastmod = Carbon::parse($article->updated_at)->toAtomString();

            $xml .= "  <url>\n";
            $xml .= "    <loc>{$url}</loc>\n";
            $xml .= "    <lastmod>{$lastmod}</lastmod>\n";
            $xml .= "    <changefreq>monthly</changefreq>\n";
            $xml .= "    <priority>0.6</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }


    public function generateAndSave(): JsonResponse
    {
        $xml = $this->generateSitemapIndex();
        File::put(public_path('sitemap.xml'), $xml);

        return response()->json(['message' => '✅ sitemap.xml berhasil disimpan']);
    }

    private function generateSitemapIndex(): string
    {
        $countries = ['us', 'gb', 'ca', 'au', 'de', 'jp'];
        $categories = InsuranceCategory::select('slug', 'updated_at')->get();
        $now = Carbon::now()->toAtomString();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Static pages
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
            $xml .= "    <loc>{$url}</loc>\n";
            $xml .= "    <lastmod>{$now}</lastmod>\n";
            $xml .= "    <changefreq>monthly</changefreq>\n";
            $xml .= "    <priority>0.8</priority>\n";
            $xml .= "  </sitemap>\n";
        }

        // Country index
        foreach ($countries as $country) {
            $url = url("/{$country}");
            $xml .= "  <sitemap>\n";
            $xml .= "    <loc>{$url}</loc>\n";
            $xml .= "    <lastmod>{$now}</lastmod>\n";
            $xml .= "    <changefreq>weekly</changefreq>\n";
            $xml .= "    <priority>0.7</priority>\n";
            $xml .= "  </sitemap>\n";
        }

        // Category per country
        foreach ($countries as $country) {
            foreach ($categories as $category) {
                $url = url("/{$country}/category/{$category->slug}");
                $lastmod = Carbon::parse($category->updated_at ?? $now)->toAtomString();
                $xml .= "  <sitemap>\n";
                $xml .= "    <loc>{$url}</loc>\n";
                $xml .= "    <lastmod>{$lastmod}</lastmod>\n";
                $xml .= "    <changefreq>monthly</changefreq>\n";
                $xml .= "    <priority>0.6</priority>\n";
                $xml .= "  </sitemap>\n";
            }
        }

        // Article batches
        $total = InsuranceArticle::count();
        $perPage = 1000;
        $pages = ceil($total / $perPage);
        for ($i = 1; $i <= $pages; $i++) {
            $url = url("/sitemap-articles-{$i}.xml");

            $last = InsuranceArticle::orderBy('updated_at', 'desc')
                ->skip(($i - 1) * $perPage)
                ->take(1)
                ->first();
            $lastmod = $last ? Carbon::parse($last->updated_at)->toAtomString() : $now;

            $xml .= "  <sitemap>\n";
            $xml .= "    <loc>{$url}</loc>\n";
            $xml .= "    <lastmod>{$lastmod}</lastmod>\n";
            $xml .= "    <changefreq>weekly</changefreq>\n";
            $xml .= "    <priority>0.5</priority>\n";
            $xml .= "  </sitemap>\n";
        }

        $xml .= '</sitemapindex>';
        return $xml;
    }
}
