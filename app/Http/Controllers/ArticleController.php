<?php

namespace App\Http\Controllers;

use App\Models\InsuranceArticle;
use App\Models\Category;
use App\Models\InsuranceCategory as ModelsInsuranceCategory;
use Illuminate\Http\InsuranceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use League\CommonMark\CommonMarkConverter;


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
    private function clean_markdown_ai(string $markdown): string
    {
        // Hapus kode block ` ```markdown ... ``` `
        $markdown = preg_replace('/```markdown\s*(.*?)```/s', '$1', $markdown);

        // Normalisasi line ending
        $markdown = str_replace("\r", '', $markdown);

        // Tambahkan baris kosong setelah heading jika belum ada
        $markdown = preg_replace('/(#+ .+)\n(?!\n)/', "$1\n\n", $markdown);

        // Tambahkan baris kosong sebelum list jika langsung menempel
        $markdown = preg_replace('/([^\n])(\n\* )/', "$1\n$2", $markdown);

        // Tambahkan baris kosong setelah list
        $markdown = preg_replace('/(\* .+)\n(?!\*)/', "$1\n\n", $markdown);

        // Hapus tab
        $markdown = str_replace("\t", '', $markdown);

        // Normalisasi newline
        $markdown = preg_replace("/\n{3,}/", "\n\n", $markdown);

        // Hapus trailing whitespace
        $markdown = preg_replace("/[ \t]+$/m", '', $markdown);

        return trim($markdown);
    }


    public function show($country, $category_slug, $article_slug)
    {
        $country = strtolower($country);
        $validCountries = ['us', 'gb', 'ca', 'au', 'de', 'jp'];
        if (!in_array($country, $validCountries)) {
            abort(404);
        }

        $article = InsuranceArticle::with(['category', 'relatedArticles'])
            ->where('country', strtoupper($country))
            ->where('slug', $article_slug)
            ->whereHas('category', function ($query) use ($category_slug) {
                $query->where('slug', $category_slug);
            })
            ->firstOrFail();

        $article->increment('visit_count');

        $popularArticles = InsuranceArticle::where('country', strtoupper($country))
            ->where('id', '!=', $article->id)
            ->orderBy('visit_count', 'desc')
            ->take(5)
            ->get();

        $sidebarCategories = ModelsInsuranceCategory::withCount(['articles' => function ($query) use ($country) {
            $query->where('country', strtoupper($country));
        }])
            ->orderBy('articles_count', 'desc')
            ->take(10)
            ->get();

        // ✅ Render markdown setelah dibersihkan
        $converter = new CommonMarkConverter();
        $cleanContent = $this->clean_markdown_ai($article->content);
        // dd($cleanContent);
        $renderedContent = $converter->convertToHtml($cleanContent);

        return view('articles.show', [
            'article' => $article,
            'renderedContent' => $renderedContent,
            'popularArticles' => $popularArticles,
            'sidebarCategories' => $sidebarCategories,
            'country' => $country
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

    public function upload(Request $request)
    {
        try {
            // Validasi format file
            $request->validate([
                'image' => 'required|image|mimes:jpeg,jpg|max:2048',
            ]);

            $file = $request->file('image');
            $extension = strtolower($file->getClientOriginalExtension());

            // Tolak jika bukan .jpg atau .jpeg
            if (!in_array($extension, ['jpg', 'jpeg'])) {
                return response()->json([
                    'success' => false,
                    'error' => 'Only .jpg or .jpeg files are allowed.',
                ], 400);
            }

            // Buat folder uploads jika belum ada
            $uploadPath = public_path('uploads');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Generate nama file unik
            $extension = $request->file('image')->getClientOriginalExtension();
            $originalName = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = time() . '_' . $originalName . '.' . $extension;


            // Simpan file
            $file->move($uploadPath, $fileName);

            return response()->json([
                'success' => true,
                'path' => asset("uploads/$fileName"),
                'url' => url("uploads/$fileName")
            ], 200, [], JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
