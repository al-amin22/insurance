<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\InsuranceArticle;
use App\Models\InsuranceCategory;

class SitemapController extends Controller
{
    /**
     * Sitemap Index - /sitemap.xml
     */
    public function index()
    {
        $xml = $this->generateSitemapIndex();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    /**
     * Sitemap Artikel per Halaman - /sitemap-articles-{page}.xml
     */
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

    /**
     * Simpan ke public/sitemap.xml jika diperlukan
     */
    public function generateAndSave()
    {
        $xml = $this->generateSitemapIndex();

        File::put(public_path('sitemap.xml'), $xml);

        return response()->json(['message' => '✅ sitemap.xml disimpan di public/sitemap.xml']);
    }

    /**
     * Dapatkan kode negara valid
     */
    private function getValidCountries(): array
    {
        return ['us', 'gb', 'ca', 'au', 'de', 'jp'];
    }

    /**
     * Generate sitemap index XML content
     */
    private function generateSitemapIndex(): string
    {
        $countries = $this->getValidCountries();

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
            $xml .= "  <sitemap><loc>$url</loc></sitemap>\n";
        }

        // Country Pages
        foreach ($countries as $country) {
            $xml .= "  <sitemap><loc>" . url("/$country") . "</loc></sitemap>\n";
        }

        // Category Pages per Country
        $categories = InsuranceCategory::select('slug')->get();
        foreach ($countries as $country) {
            foreach ($categories as $category) {
                $xml .= "  <sitemap><loc>" . url("/$country/category/{$category->slug}") . "</loc></sitemap>\n";
            }
        }

        // Artikel per Batch
        $totalArticles = InsuranceArticle::count();
        $perPage = 1000;
        $totalPages = ceil($totalArticles / $perPage);

        for ($i = 1; $i <= $totalPages; $i++) {
            $xml .= "  <sitemap><loc>" . url("/sitemap-articles-$i.xml") . "</loc></sitemap>\n";
        }

        $xml .= '</sitemapindex>';

        return $xml;
    }
}
