<?php

namespace App\Http\Controllers;

use App\Models\InsuranceArticle;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $countries = $request->input('countries', []);

        $results = InsuranceArticle::query()
            ->when($query, function ($q) use ($query) {
                $q->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%")
                        ->orWhere('keywords', 'like', "%{$query}%");
                });
            })
            ->when($countries, function ($q) use ($countries) {
                $q->whereIn('country', array_map('strtoupper', $countries));
            })
            ->with('category')
            ->orderBy('visit_count', 'desc')
            ->paginate(10);

        return view('search', [
            'results' => $results,
            'query' => $query,
            'selectedCountries' => $countries
        ]);
    }
}
