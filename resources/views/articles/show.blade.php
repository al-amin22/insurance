@extends('layouts.app')

@section('title', $article->title)
@section('meta_description', $article->description)
@section('meta_keywords', $article->keywords)
@section('og_image', asset($article->image_path))

<style>
    .article-content h1,
    .article-content h2,
    .article-content h3 {
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .article-content p {
        margin-bottom: 1rem;
        line-height: 1.7;
    }

    .article-content ul,
    .article-content ol {
        padding-left: 2rem;
        margin-bottom: 1rem;
    }

    .article-content li {
        margin-bottom: 0.5rem;
    }

    .article-content a {
        color: #0d6efd;
        text-decoration: underline;
    }

    .article-content a:hover {
        color: #0a58ca;
        text-decoration: none;
    }

    .article-content strong {
        font-weight: bold;
    }
</style>

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('articles.by_country', ['country' => strtolower($article->country)]) }}">{{ strtoupper($article->country) }}</a></li>
<li class="breadcrumb-item"><a href="{{ route('categories.show', ['country' => strtolower($article->country), 'slug' => $article->category->slug]) }}">{{ $article->category->name }}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ Str::limit($article->title, 50) }}</li>
@endsection

@section('content')
<article class="article-page">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Article Header -->
                <header class="mb-5">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-primary me-2">{{ strtoupper($article->country) }}</span>
                        <span class="text-muted me-3"><i class="far fa-clock me-1"></i> {{ $article->created_at->diffForHumans() }}</span>
                        <span class="text-muted"><i class="far fa-eye me-1"></i> {{ $article->visit_count }} views</span>
                    </div>

                    <h1 class="mb-3 fw-bold">{{ $article->title }}</h1>

                    @if($article->image_path)
                    <figure class="figure mb-4">
                        <img src="{{ asset($article->image_path) }}" class="figure-img img-fluid rounded" alt="{{ $article->title }}">
                        <figcaption class="figure-caption text-center mt-2 text-muted">{{ $article->title }}</figcaption>
                    </figure>
                    @endif
                </header>

                <!-- Article Content -->
                <div class="container my-5">
                    <div class="card shadow-sm">
                        <div class="card-body article-content">
                            {!! Str::markdown($article->content) !!}
                        </div>
                    </div>
                </div>


                <!-- Article Footer -->
                <footer class="border-top pt-4 mb-5">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div class="mb-2">
                            <span class="text-muted me-2">Category:</span>
                            <a href="{{ route('categories.show', ['country' => strtolower($article->country), 'slug' => $article->category->slug]) }}"
                                class="badge bg-secondary text-decoration-none">
                                {{ $article->category->name }}
                            </a>
                        </div>
                        <div class="share-buttons mb-2">
                            <span class="text-muted me-2">Share:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                class="btn btn-sm btn-outline-secondary me-1" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}"
                                class="btn btn-sm btn-outline-secondary me-1" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($article->title) }}"
                                class="btn btn-sm btn-outline-secondary" target="_blank">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </footer>

                <!-- Comments Section -->
                <section class="comments-section mb-5">
                    <h2 class="h4 fw-bold mb-4 pb-2 border-bottom">Comments</h2>
                    <div class="fb-comments" data-href="{{ url()->current() }}" data-width="100%" data-numposts="5"></div>
                </section>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 20px;">
                    <!-- Related Articles -->
                    @if($article->relatedArticles->count())
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="h6 mb-0">Related Articles</h3>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($article->relatedArticles as $related)
                            <a href="{{ route('articles.show', [
                                'country' => strtolower($related->country),
                                'category_slug' => $related->category->slug,
                                'article_slug' => $related->slug
                            ]) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    @if($related->image_path)
                                    <img src="{{ asset($related->image_path) }}" class="rounded me-3" width="60" height="60" alt="{{ $related->title }}">
                                    @endif
                                    <div>
                                        <h4 class="h6 mb-1">{{ Str::limit($related->title, 50) }}</h4>
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
                            <h3 class="h6 mb-0">Popular in {{ strtoupper($article->country) }}</h3>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($popularArticles as $popular)
                            <a href="{{ route('articles.show', [
                                    'country' => strtolower($popular->country),
                                    'category_slug' => $popular->category->slug,
                                    'article_slug' => $popular->slug
                                ]) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    @if($popular->image_path)
                                    <img src="{{ asset($popular->image_path) }}" class="rounded me-3" width="60" height="60" alt="{{ $popular->title }}">
                                    @endif
                                    <div>
                                        <h4 class="h6 mb-1">{{ Str::limit($popular->title, 50) }}</h4>
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
                            <h3 class="h6 mb-0">Categories</h3>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($sidebarCategories as $category)
                            <a href="{{ route('categories.show', ['country' => strtolower($article->country), 'slug' => $category->slug]) }}"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                {{ $category->name }}
                                <span class="badge bg-primary rounded-pill">{{ $category->articles_count }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="h6 mb-0">Newsletter</h3>
                        </div>
                        <div class="card-body">
                            <p class="small text-muted">Subscribe to get insurance tips and updates</p>
                            <form>
                                <div class="mb-3">
                                    <input type="email" class="form-control form-control-sm" placeholder="Your email">
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary w-100">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Schema.org markup for Article -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Article",
            "headline": "{{ $article->title }}",
            "description": "{{ $article->description }}",
            "image": "{{ asset($article->image_path) }}",
            "author": {
                "@type": "Organization",
                "name": "SoundEffectsFree.com"
            },
            "publisher": {
                "@type": "Organization",
                "name": "SoundEffectsFree.com",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{ asset('images/logo.png') }}"
                }
            },
            "datePublished": "{{ $article->created_at->toIso8601String() }}",
            "dateModified": "{{ $article->updated_at->toIso8601String() }}",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "{{ url()->current() }}"
            }
        }
    </script>
</article>
@endsection

@section('scripts')
<!-- Facebook SDK for Comments -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0&appId=YOUR_APP_ID&autoLogAppEvents=1" nonce="YOUR_NONCE"></script>
@endsection