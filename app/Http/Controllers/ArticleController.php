<?php

namespace App\Http\Controllers;

use App\Models\InsuranceArticle;
use App\Models\Category;
use App\Models\InsuranceCategory as ModelsInsuranceCategory;
use Illuminate\Http\InsuranceCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display the specified article.
     *
     * @param  string  $country
     * @param  string  $category_slug
     * @param  string  $article_slug
     * @return \Illuminate\Http\Response
     */
    public function show($country, $category_slug, $article_slug)
    {
        // Convert country parameter to lowercase for consistency
        $country = strtolower($country);

        // Validate country code
        $validCountries = ['us', 'gb', 'ca', 'au', 'de', 'jp'];
        if (!in_array($country, $validCountries)) {
            abort(404);
        }

        // Find article with uppercase country in database
        $article = InsuranceArticle::with(['category', 'relatedArticles'])
            ->where('country', strtoupper($country))
            ->where('slug', $article_slug)
            ->whereHas('category', function ($query) use ($category_slug) {
                $query->where('slug', $category_slug);
            })
            ->firstOrFail();

        // Increment visit count
        $article->increment('visit_count');

        // Get popular articles in the same country
        $popularArticles = InsuranceArticle::where('country', strtoupper($country))
            ->where('id', '!=', $article->id)
            ->orderBy('visit_count', 'desc')
            ->take(5)
            ->get();

        // Get categories for sidebar
        $sidebarCategories = ModelsInsuranceCategory::withCount(['articles' => function ($query) use ($country) {
            $query->where('country', strtoupper($country));
        }])
            ->orderBy('articles_count', 'desc')
            ->take(10)
            ->get();

        return view('articles.show', [
            'article' => $article,
            'popularArticles' => $popularArticles,
            'sidebarCategories' => $sidebarCategories,
            'country' => $country // lowercase for URLs
        ]);
    }

    /**
     * Display articles by country.
     *
     * @param  string  $country
     * @return \Illuminate\Http\Response
     */
    public function byCountry($country)
    {
        // Convert country to lowercase for URLs
        $country = strtolower($country);

        // Validate country code
        $validCountries = ['us', 'gb', 'ca', 'au', 'de', 'jp'];
        if (!in_array($country, $validCountries)) {
            abort(404);
        }

        // Get country name for display (keeping uppercase for display)
        $countryName = $this->getCountryName($country);

        // Get main paginated articles
        $articles = InsuranceArticle::where('country', strtoupper($country))
            ->latest()
            ->paginate(10);

        // Get categories with article count
        $categories = ModelsInsuranceCategory::withCount(['articles' => function ($query) use ($country) {
            $query->where('country', strtoupper($country));
        }])
            ->orderBy('articles_count', 'desc')
            ->get();

        // Get latest 6 articles
        $latestArticles = InsuranceArticle::where('country', strtoupper($country))
            ->with('category')
            ->latest()
            ->take(6)
            ->get();

        // Get popular articles for sidebar
        $popularArticles = InsuranceArticle::where('country', strtoupper($country))
            ->with('category')
            ->orderBy('visit_count', 'desc')
            ->take(5)
            ->get();

        return view('articles.country', [
            'articles' => $articles,
            'country' => $country, // lowercase for URLs
            'countryName' => $countryName, // uppercase for display
            'categories' => $categories,
            'latestArticles' => $latestArticles,
            'popularArticles' => $popularArticles
        ]);
    }

    protected function getCountryName($code)
    {
        $countries = [
            'us' => 'United States',
            'gb' => 'United Kingdom',
            'ca' => 'Canada',
            'au' => 'Australia',
            'de' => 'Germany',
            'jp' => 'Japan'
        ];

        return $countries[$code] ?? strtoupper($code);
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        // Validate search query
        $request->validate([
            'q' => 'required|string|min:3|max:255'
        ]);

        // Search in articles (title, description, content)
        $results = InsuranceArticle::query()
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->orWhere('content', 'LIKE', "%{$query}%");
            })
            ->with('category')
            ->paginate(10)
            ->appends(['q' => $query]);

        return view('articles.search', [
            'results' => $results,
            'searchQuery' => $query
        ]);
    }
}
