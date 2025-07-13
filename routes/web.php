<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SitemapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::get('/sitemap-articles-{page}.xml', [SitemapController::class, 'articles']);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/search', [ArticleController::class, 'search'])->name('search');

// Article routes
Route::prefix('{country}')->group(function () {
    // Articles by country
    Route::get('/', [ArticleController::class, 'byCountry'])
        ->where('country', '[a-z]{2}')
        ->name('articles.by_country');

    // Category listing
    Route::get('/category/{slug}', [CategoryController::class, 'show'])
        ->name('categories.show');

    // Single article
    // Make sure the route pattern forces lowercase
    Route::get('/{category_slug}/{article_slug}', [ArticleController::class, 'show'])
        ->where('country', 'us|gb|ca|au|de|jp')
        ->name('articles.show');
});

// Contact Routes
Route::prefix('contact')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('contact');
    Route::post('/', [ContactController::class, 'store'])->name('contact.store');
});
// Static pages
Route::get('/about', function () {
    return view('page.about');
})->name('about');

// Legal Pages
Route::prefix('policies')->group(function () {
    Route::get('privacy', function () {
        return view('page.privacy');
    })->name('privacy');

    Route::get('terms', function () {
        return view('page.terms');
    })->name('terms');

    Route::get('licensing', function () {
        return view('page.licensing');
    })->name('licensing');

    Route::get('dmca', function () {
        return view('page.dmca');
    })->name('dmca');
});
