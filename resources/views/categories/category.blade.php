@extends('layouts.app')

@section('title', $category->name . ' Insurance Guides - SoundEffectsFree.com')
@section('meta_description', 'Comprehensive guides about ' . $category->name . ' insurance. Compare options and find the best coverage for your needs.')
@section('meta_keywords', $category->name . ' insurance, ' . strtolower($category->name) . ' coverage, ' . strtolower($category->name) . ' policy')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('articles.by_country', $country) }}">{{ strtoupper($country) }}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Category Header -->
            <header class="mb-5">
                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-primary me-2">{{ strtoupper($country) }}</span>
                    <span class="text-muted">{{ $articles->total() }} articles</span>
                </div>
                <h1 class="fw-bold mb-3">{{ $category->name }} Insurance Guides</h1>
                <p class="lead">Comprehensive information and comparisons for {{ strtolower($category->name) }} insurance policies.</p>
            </header>

            <!-- Articles List -->
            <div class="articles-list">
                @forelse($articles as $article)
                <article class="card mb-4 border-0 shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <a href="{{ route('articles.show', [
                                'country' => $country,
                                'category_slug' => $category->slug,
                                'article_slug' => $article->slug
                            ]) }}">
                                @if($article->image_path)
                                <img src="{{ asset($article->image_path) }}" class="img-fluid rounded-start" alt="{{ $article->title }}" style="height: 200px; width: 100%; object-fit: cover;">
                                @endif
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                                    <span class="mx-2">•</span>
                                    <small class="text-muted"><i class="fas fa-eye me-1"></i> {{ $article->visit_count }}</small>
                                </div>
                                <h2 class="h5 card-title">
                                    <a href="{{ route('articles.show', [
                                        'country' => $country,
                                        'category_slug' => $category->slug,
                                        'article_slug' => $article->slug
                                    ]) }}" class="text-decoration-none">{{ $article->title }}</a>
                                </h2>
                                <p class="card-text">{{ Str::limit($article->description, 150) }}</p>
                                <a href="{{ route('articles.show', [
                                    'country' => $country,
                                    'category_slug' => $category->slug,
                                    'article_slug' => $article->slug
                                ]) }}" class="btn btn-sm btn-outline-primary">Read Guide</a>
                            </div>
                        </div>
                    </div>
                </article>
                @empty
                <div class="alert alert-info">
                    No articles found in this category. Check back later!
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($articles->hasPages())
            <nav aria-label="Page navigation" class="mt-4">
                {{ $articles->onEachSide(1)->links('pagination::bootstrap-5') }}
            </nav>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 20px;">
                <!-- Category Description -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="h6 mb-0">About {{ $category->name }} Insurance</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $category->description ?? 'Learn everything you need to know about ' . strtolower($category->name) . ' insurance, including coverage options, pricing factors, and how to choose the best policy for your needs.' }}</p>
                    </div>
                </div>

                <!-- Popular in Category -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="h6 mb-0">Popular in {{ $category->name }}</h3>
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach($popularInCategory as $popular)
                        <a href="{{ route('articles.show', [
                            'country' => $country,
                            'category_slug' => $category->slug,
                            'article_slug' => $popular->slug
                        ]) }}" class="list-group-item list-group-item-action">

                            <div class="d-flex align-items-center">
                                @if($popular->image_path)
                                <img src="{{ asset($popular->image_path) }}" class="rounded me-3" width="60" height="60" alt="{{ $popular->title }}">
                                @endif
                                <div>
                                    <h4 class="h6 mb-1">{{ Str::limit($popular->title, 50) }}</h4>
                                    <small class="text-muted">{{ $popular->visit_count }} views</small>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="h6 mb-0">Get Insurance Tips</h3>
                    </div>
                    <div class="card-body">
                        <p class="small text-muted">Subscribe to our newsletter for {{ strtolower($category->name) }} insurance updates</p>
                        <form>
                            <div class="mb-3">
                                <input type="email" class="form-control form-control-sm" placeholder="Your email" required>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary w-100">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
