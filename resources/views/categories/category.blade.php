@extends('layouts.app')

@section('title', e($category->name . ' Insurance Guide for ' . strtoupper($country)))
@section('meta_description', 'Comprehensive guides about ' . $category->name . ' insurance in ' . strtoupper($country) . '. Compare options and find the best coverage for your needs.')
@section('meta_keywords', $category->name . ' insurance, ' . strtolower($category->name) . ' coverage, ' . strtolower($category->name) . ' policy, ' . strtolower($country) . ' insurance')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('articles.by_country', $country) }}">{{ strtoupper($country) }}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
@endsection

@section('content')
<div class="container py-3 py-lg-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Category Header -->
            <header class="mb-4 mb-lg-5">
                <div class="d-flex flex-wrap align-items-center mb-3">
                    <span class="badge bg-primary me-2 mb-1">{{ strtoupper($country) }}</span>
                    <span class="text-muted mb-1">{{ number_format($articles->total()) }} articles</span>
                </div>
                <h1 class="fw-bold mb-3">{{ $category->name }} Insurance Guides</h1>
                <p class="lead mb-0">
                    Comprehensive information and comparisons for {{ strtolower($category->name) }} insurance policies in {{ strtoupper($country) }}.
                </p>
            </header>

            <!-- Articles List -->
            <div class="articles-list">
                @forelse($articles as $article)
                <article class="card mb-4 border-0 shadow-sm hover-shadow">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <a href="{{ route('articles.show', ['country' => $country, 'category_slug' => $category->slug, 'article_slug' => $article->slug]) }}"
                                aria-label="Read {{ $article->title }}">
                                @if($article->image_path)
                                <img src="{{ asset($article->image_path) }}"
                                    class="img-fluid rounded-start"
                                    alt="{{ $article->title }}"
                                    style="height: 200px; width: 100%; object-fit: cover;"
                                    loading="lazy">
                                @endif
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center mb-2">
                                    <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                                    <span class="mx-2 d-none d-md-inline">•</span>
                                    <small class="text-muted">
                                        <i class="fas fa-eye me-1"></i> {{ number_format($article->visit_count) }}
                                    </small>
                                </div>
                                <h2 class="h5 card-title">
                                    <a href="{{ route('articles.show', ['country' => $country, 'category_slug' => $category->slug, 'article_slug' => $article->slug]) }}"
                                        class="text-decoration-none">{{ $article->title }}</a>
                                </h2>
                                <p class="card-text">{{ Str::limit($article->description, 150) }}</p>
                                <a href="{{ route('articles.show', ['country' => $country, 'category_slug' => $category->slug, 'article_slug' => $article->slug]) }}"
                                    class="btn btn-sm btn-outline-primary">Read Guide</a>
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
            <div class="sticky-lg-top" style="top: 20px;">
                <!-- Category Description -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="h6 mb-0">About {{ $category->name }} Insurance</h2>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            {{ $category->description ?? 'Learn everything you need to know about ' . strtolower($category->name) . ' insurance, including coverage options, pricing factors, and how to choose the best policy for your needs.' }}
                        </p>
                    </div>
                </div>

                <!-- Popular in Category -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="h6 mb-0">Popular in {{ $category->name }}</h2>
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach($popularInCategory as $popular)
                        <a href="{{ route('articles.show', ['country' => $country, 'category_slug' => $category->slug, 'article_slug' => $popular->slug]) }}"
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
                                    <small class="text-muted">{{ number_format($popular->visit_count) }} views</small>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="h6 mb-0">Get Insurance Tips</h2>
                    </div>
                    <div class="card-body">
                        <p class="small text-muted">Subscribe to our newsletter for {{ strtolower($category->name) }} insurance updates</p>
                        <form action="{{ route('newsletter.subscribe') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control form-control-sm" placeholder="Your email" aria-label="Your email address" required>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary w-100">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Schema.org markup for Category Page -->
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CollectionPage",
        "name": "{{ $category->name }} Insurance Guides",
        "description": "Comprehensive information about {{ $category->name }} insurance in {{ strtoupper($country) }}",
        "url": "{{ url()->current() }}",
        "about": {
            "@type": "Thing",
            "name": "{{ $category->name }} Insurance"
        },
        "hasPart": [\@foreach($articles as $article) {
                "@type": "Article",
                "headline": "{{ $article->title }}",
                "url": "{{ route('articles.show', ['country' => $country, 'category_slug' => $category->slug, 'article_slug' => $article->slug]) }}",
                "datePublished": "{{ $article->created_at->toIso8601String() }}",
                "image": "{{ asset($article->image_path) }}"
            } {
                {
                    !$loop - > last ? ',' : ''
                }
            }\
            @endforeach
        ]
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
                "name": "{{ strtoupper($country) }} Insurance",
                "item": "{{ route('articles.by_country', $country) }}"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $category->name }}",
                "item": "{{ url()->current() }}"
            }
        ]
    }
</script>
@endsection

@push('styles')
<style>
    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .articles-list .card {
            flex-direction: column !important;
        }

        .articles-list .col-md-4,
        .articles-list .col-md-8 {
            width: 100%;
            padding: 1rem;
        }

        .articles-list img {
            border-radius: 0.25rem 0.25rem 0 0 !important;
            height: 180px !important;
        }

        .list-group-item img {
            width: 50px !important;
            height: 50px !important;
        }
    }

    @media (max-width: 575.98px) {
        .articles-list img {
            height: 160px !important;
        }

        .lead {
            font-size: 1rem;
        }
    }

    /* Hover Effects */
    .hover-shadow {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .hover-shadow:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1) !important;
    }

    /* Print Styles */
    @media print {

        .sidebar,
        .card-header,
        .btn {
            display: none !important;
        }

        .articles-list .card {
            break-inside: avoid;
            margin-bottom: 1rem;
        }
    }
</style>
@endpush