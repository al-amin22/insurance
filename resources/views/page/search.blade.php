@extends('layouts.app')

@section('title', 'Search Insurance Guides - SoundEffectsFree.com')
@section('meta_description', 'Search our comprehensive insurance guides and comparisons')
@section('meta_keywords', 'search insurance, find insurance guides, insurance comparison')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Search</li>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Search Header -->
            <header class="mb-5 text-center">
                <h1 class="fw-bold mb-3">Search Insurance Guides</h1>
                <form action="{{ url('/search') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control form-control-lg"
                            placeholder="Search for insurance topics..." value="{{ request('q') }}">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="us" name="countries[]" value="us"
                                {{ in_array('us', request('countries', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="us">US</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="gb" name="countries[]" value="gb"
                                {{ in_array('gb', request('countries', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="gb">UK</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="ca" name="countries[]" value="ca"
                                {{ in_array('ca', request('countries', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="ca">Canada</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="au" name="countries[]" value="au"
                                {{ in_array('au', request('countries', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="au">Australia</label>
                        </div>
                    </div>
                </form>
                @if(request()->has('q'))
                <p class="text-muted">Showing results for "{{ request('q') }}"</p>
                @endif
            </header>

            <!-- Search Results -->
            <section class="search-results">
                @if($results->count())
                <div class="list-group mb-5">
                    @foreach($results as $article)
                    <a href="{{ route('articles.show', [
                        'country' => strtolower($article->country),
                        'category_slug' => $article->category->slug,
                        'article_slug' => $article->slug
                    ])" class="list-group-item list-group-item-action">
                        <div class="d-flex align-items-center">
                            @if($article->image_path)
                            <img src="{{ asset($article->image_path) }}" class="rounded me-4" width="80" height="80" alt="{{ $article->title }}">
                        @endif
                        <div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-primary me-2">{{ strtoupper($article->country) }}</span>
                                <small class="text-muted">{{ $article->category->name }}</small>
                            </div>
                            <h3 class="h5 mb-1">{{ $article->title }}</h3>
                            <p class="mb-1 text-muted">{{ Str::limit($article->description, 120) }}</p>
                            <small class="text-muted">{{ $article->created_at->diffForHumans() }} • {{ $article->visit_count }} views</small>
                        </div>
                </div>
                </a>
                @endforeach
        </div>

        <!-- Pagination -->
        {{ $results->appends(request()->query())->links('pagination::bootstrap-5') }}
        @elseif(request()->has('q'))
        <div class="alert alert-info">
            No results found for "{{ request('q') }}". Try different keywords.
        </div>
        @else
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-4"></i>
                <h3 class="h4 mb-3">Search Insurance Guides</h3>
                <p class="text-muted mb-0">Enter keywords to find insurance information and comparisons</p>
            </div>
        </div>
        @endif
        </section>

        <!-- Popular Searches -->
        <section class="mt-5">
            <h2 class="h4 fw-bold mb-4 pb-2 border-bottom">Popular Searches</h2>
            <div class="d-flex flex-wrap gap-2">
                <a href="/search?q=health+insurance" class="btn btn-sm btn-outline-secondary">Health Insurance</a>
                <a href="/search?q=car+insurance" class="btn btn-sm btn-outline-secondary">Car Insurance</a>
                <a href="/search?q=home+insurance" class="btn btn-sm btn-outline-secondary">Home Insurance</a>
                <a href="/search?q=life+insurance" class="btn btn-sm btn-outline-secondary">Life Insurance</a>
                <a href="/search?q=travel+insurance" class="btn btn-sm btn-outline-secondary">Travel Insurance</a>
                <a href="/search?q=cheap+insurance" class="btn btn-sm btn-outline-secondary">Cheap Insurance</a>
                <a href="/search?q=insurance+comparison" class="btn btn-sm btn-outline-secondary">Insurance Comparison</a>
                <a href="/search?q=best+insurance" class="btn btn-sm btn-outline-secondary">Best Insurance</a>
            </div>
        </section>
    </div>
</div>
</div>
@endsection
