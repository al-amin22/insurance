@extends('layouts.app')
@php
use Illuminate\Support\Str;
@endphp

@section('title', $article->title . ' - ' . strtoupper($article->country) . ' Insurance Guide')
@section('meta_description', $article->description)
@section('meta_keywords', $article->keywords . ', ' . strtolower($article->country) . ' insurance, ' . $article->category->name . ' guide')
@section('og_image', asset($article->image_path))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('articles.by_country', ['country' => strtolower($article->country)]) }}">{{ strtoupper($article->country) }}</a></li>
<li class="breadcrumb-item"><a href="{{ route('categories.show', ['country' => strtolower($article->country), 'slug' => $article->category->slug]) }}">{{ $article->category->name }}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ Str::limit($article->title, 50) }}</li>
@endsection

@section('content')
<article class="article-page">
    <div class="container py-3 py-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Article Header -->
                <header class="mb-4 mb-lg-5">
                    <div class="d-flex flex-wrap align-items-center mb-3">
                        <span class="badge bg-primary me-2 mb-1">{{ strtoupper($article->country) }}</span>
                        <span class="text-muted me-3 mb-1"><i class="far fa-clock me-1"></i> {{ $article->created_at->diffForHumans() }}</span>
                        <span class="text-muted mb-1"><i class="far fa-eye me-1"></i> {{ number_format($article->visit_count) }} views</span>
                    </div>

                    <h1 class="mb-3 fw-bold">{{ $article->title }}</h1>

                    @if($article->image_path)
                    <figure class="figure mb-4">
                        <img src="{{ asset($article->image_path) }}"
                            class="figure-img img-fluid rounded"
                            alt="{{ $article->title }}"
                            loading="lazy"
                            width="800"
                            height="450">
                        <figcaption class="figure-caption text-center mt-2 text-muted small">{{ $article->image_caption ?? $article->title }}</figcaption>
                    </figure>
                    @endif
                </header>

                <!-- Article Content -->
                <div class="article-content-container mb-4 mb-lg-5">
                    <div class="card shadow-sm">
                        <div class="card-body article-content">
                            {!! $renderedContent !!}
                        </div>
                    </div>
                </div>

                <!-- Article Footer -->
                <footer class="border-top pt-4 mb-4 mb-lg-5">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <div class="mb-2 mb-md-0">
                            <span class="text-muted me-2">Category:</span>
                            <a href="{{ route('categories.show', ['country' => strtolower($article->country), 'slug' => $article->category->slug]) }}"
                                class="badge bg-secondary text-decoration-none">
                                {{ $article->category->name }}
                            </a>
                        </div>
                        <div class="share-buttons">
                            <span class="text-muted me-2 d-none d-md-inline">Share:</span>
                            <div class="btn-group" role="group" aria-label="Share buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                    class="btn btn-sm btn-outline-secondary"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="Share on Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}"
                                    class="btn btn-sm btn-outline-secondary"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="Share on Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($article->title) }}"
                                    class="btn btn-sm btn-outline-secondary"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="Share on LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </footer>

                <!-- Comments Section -->
                <section class="comments-section mb-4 mb-lg-5">
                    <h2 class="h4 fw-bold mb-3 pb-2 border-bottom">Comments</h2>
                    <div class="fb-comments"
                        data-href="{{ url()->current() }}"
                        data-width="100%"
                        data-numposts="5"
                        data-lazy="true">
                    </div>
                </section>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-lg-top" style="top: 20px;">
                    <!-- Related Articles -->
                    @if($article->relatedArticles->count())
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h2 class="h6 mb-0">Related Articles</h2>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($article->relatedArticles as $related)
                            <a href="{{ route('articles.show', [
                                'country' => strtolower($related->country),
                                'category_slug' => $related->category->slug,
                                'article_slug' => $related->slug
                            ]) }}"
                                class="list-group-item list-group-item-action"
                                aria-label="Read {{ Str::limit($related->title, 50) }}">
                                <div class="d-flex align-items-center">
                                    @if($related->image_path)
                                    <img src="{{ asset($related->image_path) }}"
                                        class="rounded me-3"
                                        width="60"
                                        height="60"
                                        alt="{{ $related->title }}"
                                        loading="lazy">
                                    @endif
                                    <div>
                                        <h3 class="h6 mb-1">{{ Str::limit($related->title, 50) }}</h3>
                                        <small class="text-muted">{{ $related->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Popular Articles -->
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h2 class="h6 mb-0">Popular in {{ strtoupper($article->country) }}</h2>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($popularArticles as $popular)
                            <a href="{{ route('articles.show', [
                                    'country' => strtolower($popular->country),
                                    'category_slug' => $popular->category->slug,
                                    'article_slug' => $popular->slug
                                ]) }}"
                                class="list-group-item list-group-item-action"
                                aria-label="Read {{ Str::limit($popular->title, 50) }}">
                                <div class="d-flex align-items-center">
                                    @if($popular->image_path)
                                    <img src="{{ asset($popular->image_path) }}"
                                        class="rounded me-3"
                                        width="60"
                                        height="60"
                                        alt="{{ $popular->title }}"
                                        loading="lazy">
                                    @endif
                                    <div>
                                        <h3 class="h6 mb-1">{{ Str::limit($popular->title, 50) }}</h3>
                                        <small class="text-muted">{{ $popular->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h2 class="h6 mb-0">Categories</h2>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($sidebarCategories as $category)
                            <a href="{{ route('categories.show', ['country' => strtolower($article->country), 'slug' => $category->slug]) }}"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                aria-label="Browse {{ $category->name }} category">
                                {{ $category->name }}
                                <span class="badge bg-primary rounded-pill">{{ $category->articles_count }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h2 class="h6 mb-0">Newsletter</h2>
                        </div>
                        <div class="card-body">
                            <p class="small text-muted">Subscribe to get insurance tips and updates</p>
                            <form action="{{ route('newsletter.subscribe') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="email"
                                        name="email"
                                        class="form-control form-control-sm"
                                        placeholder="Your email"
                                        aria-label="Your email address"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary w-100">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

<!-- Schema.org markup for Article -->
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "NewsArticle",
        "headline": "{{ $article->title }}",
        "description": "{{ $article->description }}",
        "image": {
            "@type": "ImageObject",
            "url": "{{ asset($article->image_path) }}",
            "width": 800,
            "height": 450
        },
        "author": {
            "@type": "Organization",
            "name": "coverinsight.com",
            "url": "{{ url('/') }}"
        },
        "publisher": {
            "@type": "Organization",
            "name": "coverinsight.com",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ asset('images/logo.png') }}",
                "width": 200,
                "height": 60
            }
        },
        "datePublished": "{{ $article->created_at->toIso8601String() }}",
        "dateModified": "{{ $article->updated_at->toIso8601String() }}",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ url()->current() }}"
        },
        "articleSection": "{{ $article->category->name }}",
        "keywords": "{{ $article->keywords }}"
    }
</script>

<!-- Breadcrumb Schema -->
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "{{ url('/') }}"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "{{ strtoupper($article->country) }} Insurance",
                "item": "{{ route('articles.by_country', ['country' => strtolower($article->country)]) }}"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $article->category->name }}",
                "item": "{{ route('categories.show', ['country' => strtolower($article->country), 'slug' => $article->category->slug]) }}"
            },
            {
                "@type": "ListItem",
                "position": 4,
                "name": "{{ $article->title }}",
                "item": "{{ url()->current() }}"
            }
        ]
    }
</script>
@endsection

@section('scripts')
<!-- Facebook SDK for Comments -->
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0&appId=YOUR_APP_ID&autoLogAppEvents=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
@endsection

<style>
    /* Article Content Styling */
    .article-content {
        font-size: 1rem;
        line-height: 1.7;
        color: #333;
    }

    .article-content h1,
    .article-content h2,
    .article-content h3 {
        font-weight: bold;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .article-content h1 {
        font-size: 1.8rem;
    }

    .article-content h2 {
        font-size: 1.5rem;
    }

    .article-content h3 {
        font-size: 1.3rem;
    }

    .article-content p {
        margin-bottom: 1.2rem;
    }

    .article-content ul,
    .article-content ol {
        padding-left: 1.5rem;
        margin-bottom: 1.2rem;
    }

    .article-content li {
        margin-bottom: 0.5rem;
    }

    .article-content a {
        color: #0d6efd;
        text-decoration: underline;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        margin: 1rem 0;
        border-radius: 0.25rem;
    }

    .article-content table {
        width: 100%;
        margin-bottom: 1rem;
        border-collapse: collapse;
    }

    .article-content table th,
    .article-content table td {
        padding: 0.75rem;
        border: 1px solid #dee2e6;
    }

    .article-content table th {
        background-color: #f8f9fa;
    }

    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .article-content {
            font-size: 0.95rem;
            padding: 1rem;
        }

        .article-content h1 {
            font-size: 1.5rem;
        }

        .article-content h2 {
            font-size: 1.3rem;
        }

        .article-content h3 {
            font-size: 1.1rem;
        }

        .article-content-container {
            margin-left: -0.75rem;
            margin-right: -0.75rem;
        }

        .share-buttons .btn {
            padding: 0.25rem 0.5rem;
        }

        .list-group-item {
            padding: 0.75rem;
        }

        .list-group-item img {
            width: 50px !important;
            height: 50px !important;
        }
    }

    @media (max-width: 575.98px) {
        .article-content {
            font-size: 0.9rem;
        }

        .article-content h1 {
            font-size: 1.3rem;
        }
    }

    /* Print Styles */
    @media print {
        .article-content {
            font-size: 12pt;
            line-height: 1.5;
        }

        .article-content a {
            text-decoration: underline;
        }

        .sidebar,
        .comments-section,
        .share-buttons {
            display: none !important;
        }
    }
</style>