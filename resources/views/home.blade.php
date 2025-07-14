@extends('layouts.app')

@section('title', 'Insurance Information &amp; Simple Insurance 2025')
@section('meta_description', 'Trusted insurance guides for health, auto, home, and life insurance in US, UK, Canada, Australia, Germany & Japan. Expert comparisons to help you save.')
@section('meta_keywords', 'insurance guide, compare insurance, health insurance, car insurance, home insurance, life insurance, insurance tips, US insurance, UK insurance, Canada insurance')

@section('content')
<section class="hero-section bg-primary text-white py-4 py-lg-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-5 display-lg-4 fw-bold mb-3">Insurance Made Simple for 2025</h1>
                <p class="lead mb-4">Data-driven insurance comparisons and expert guides to help you find optimal coverage in the US, UK, Canada, Australia, Germany, and Japan.</p>
                <div class="d-flex flex-wrap gap-2 gap-md-3">
                    <a href="{{ route('articles.by_country', 'us') }}" class="btn btn-light btn-lg px-3 px-md-4" aria-label="Explore country insurance guides">
                        Country Insurance <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <a href="#popular-categories" class="btn btn-outline-light btn-lg px-3 px-md-4" aria-label="Browse insurance types">
                        Insurance Types
                    </a>
                </div>
                <div class="mt-3 mt-md-4">
                    <span class="badge bg-white text-primary me-2 mb-2">Trusted Research</span>
                    <span class="badge bg-white text-primary mb-2">Updated Daily</span>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/erasebg-transformed.png') }}"
                    alt="Insurance Comparison Guide 2025"
                    class="img-fluid rounded shadow"
                    loading="lazy"
                    width="600"
                    height="400">
            </div>
        </div>
    </div>
</section>

<!-- Featured Insurance Comparisons -->
<section class="py-4 py-lg-5 bg-light">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <h2 class="h3 fw-bold mb-3 mb-md-0">Latest Insurance Comparisons</h2>
            <a href="{{ route('articles.by_country', 'us') }}" class="btn btn-sm btn-outline-primary" aria-label="View all insurance guides">
                View All Guides <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-3 g-md-4">
            @foreach($popularArticles as $article)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                    <a href="{{ route('articles.show', [
                            'country' => strtolower($article->country),
                            'category_slug' => $article->category->slug,
                            'article_slug' => $article->slug
                        ]) }}"
                        class="text-decoration-none"
                        aria-label="Read {{ $article->title }}">

                        @if($article->image_path)
                        <img src="{{ asset($article->image_path) }}"
                            class="card-img-top"
                            alt="{{ $article->title }} insurance guide"
                            style="height: 200px; object-fit: cover;"
                            loading="lazy"
                            width="400"
                            height="200">
                        @endif

                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center mb-2">
                                <span class="badge bg-primary me-2 mb-1">{{ strtoupper($article->country) }}</span>
                                <small class="text-muted mb-1">{{ $article->category->name }}</small>
                            </div>
                            <h3 class="h5 card-title">{{ $article->title }}</h3>
                            <p class="card-text text-muted small">{{ Str::limit($article->description, 100) }}</p>
                        </div>

                        <div class="card-footer bg-transparent border-top-0 pt-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                                <small class="text-muted">
                                    <i class="fas fa-eye me-1"></i> {{ number_format($article->visit_count) }}
                                </small>
                            </div>
                        </div>

                    </a>
                </div>

            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Country-Specific Insurance Guides -->
<section class="py-4 py-lg-5">
    <div class="container">
        <h2 class="text-center mb-4 mb-lg-5 h3 fw-bold">Country-Specific Insurance Guides</h2>
        <p class="text-center mb-4 text-muted">Select your country for localized insurance information and regulations</p>

        <div class="row g-3 g-md-4 justify-content-center">
            @php
            $countries = [
            'us' => ['name' => 'United States', 'flag' => '🇺🇸', 'desc' => 'Health, auto & home insurance guides'],
            'gb' => ['name' => 'United Kingdom', 'flag' => '🇬🇧', 'desc' => 'NHS, car & home insurance'],
            'ca' => ['name' => 'Canada', 'flag' => '🇨🇦', 'desc' => 'Provincial health & auto insurance'],
            'au' => ['name' => 'Australia', 'flag' => '🇦🇺', 'desc' => 'Medicare & private health insurance'],
            'de' => ['name' => 'Germany', 'flag' => '🇩🇪', 'desc' => 'German health & liability insurance'],
            'jp' => ['name' => 'Japan', 'flag' => '🇯🇵', 'desc' => 'Shakai Hoken & Japanese auto insurance']
            ];
            @endphp

            @foreach($countries as $code => $country)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <a href="{{ route('articles.by_country', $code) }}"
                    class="card country-card text-center border-0 shadow-sm h-100 text-decoration-none"
                    aria-label="{{ $country['name'] }} insurance guides">
                    <div class="card-body">
                        <div class="display-4 mb-3">{{ $country['flag'] }}</div>
                        <h3 class="h6 mb-1">{{ $country['name'] }}</h3>
                        <small class="text-muted d-block">{{ $country['desc'] }}</small>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 pt-0">
                        <small class="text-primary">View Guides →</small>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Insurance Type Categories -->
<section id="popular-categories" class="py-4 py-lg-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4 mb-lg-5 h3 fw-bold">Insurance Types We Cover</h2>
        <p class="text-center mb-4 text-muted">Comprehensive guides for all major insurance categories</p>

        <div class="row g-3 g-md-4">
            @foreach($categories as $category)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <a href="{{ route('categories.show', ['country' => 'us', 'slug' => $category->slug]) }}"
                    class="card category-card border-0 shadow-sm h-100 text-decoration-none"
                    aria-label="{{ $category->name }} insurance guides">
                    <div class="card-body text-center">
                        @php
                        $icon = match(true) {
                        str_contains(strtolower($category->name), 'health') => 'fas fa-heartbeat',
                        str_contains(strtolower($category->name), 'auto') || str_contains(strtolower($category->name), 'car') => 'fas fa-car',
                        str_contains(strtolower($category->name), 'home') => 'fas fa-home',
                        str_contains(strtolower($category->name), 'life') => 'fas fa-shield-alt',
                        str_contains(strtolower($category->name), 'travel') => 'fas fa-plane',
                        str_contains(strtolower($category->name), 'pet') => 'fas fa-paw',
                        str_contains(strtolower($category->name), 'business') => 'fas fa-briefcase',
                        str_contains(strtolower($category->name), 'liability') => 'fas fa-balance-scale',
                        str_contains(strtolower($category->name), 'disability') => 'fas fa-wheelchair',
                        default => 'fas fa-file-alt'
                        };
                        @endphp
                        <div class="icon-wrapper bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-3">
                            <i class="{{ $icon }} fs-4"></i>
                        </div>
                        <h3 class="h6 mb-1">{{ $category->name }}</h3>
                        <small class="text-muted">{{ $category->articles_count }} guides</small>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Trust Signals Section -->
<section class="py-4 py-lg-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="text-center h3 fw-bold mb-4 mb-lg-5">Why Trust Our Insurance Guides?</h2>
                <div class="row g-3 g-md-4">
                    <div class="col-md-4">
                        <div class="p-3 p-md-4 text-center">
                            <div class="icon-wrapper bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-3">
                                <i class="fas fa-chart-line fs-4"></i>
                            </div>
                            <h3 class="h5 mb-2">Data-Driven</h3>
                            <p class="text-muted small mb-0">Our comparisons are based on actual market research and pricing data</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 p-md-4 text-center">
                            <div class="icon-wrapper bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-3">
                                <i class="fas fa-user-tie fs-4"></i>
                            </div>
                            <h3 class="h5 mb-2">Expert Reviewed</h3>
                            <p class="text-muted small mb-0">All content is reviewed by licensed insurance professionals</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 p-md-4 text-center">
                            <div class="icon-wrapper bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-3">
                                <i class="fas fa-sync-alt fs-4"></i>
                            </div>
                            <h3 class="h5 mb-2">Regularly Updated</h3>
                            <p class="text-muted small mb-0">We update our guides quarterly to reflect current market conditions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-4 py-lg-5 bg-primary text-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h2 class="h2 fw-bold mb-3">Ready to Find Better Insurance?</h2>
                <p class="lead mb-4 mb-lg-5 opacity-75">Start with our expert-curated guides to make informed decisions about your coverage.</p>
                <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                    <a href="{{ route('articles.by_country', 'us') }}" class="btn btn-light btn-lg px-4" aria-label="Get started with insurance guides">
                        Get Started Now <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <a href="/about" class="btn btn-outline-light btn-lg px-4" aria-label="Learn about our methodology">
                        Our Methodology
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Schema.org markup -->
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "CoverInsight - Insurance Indormation & Simple Insurance 2025",
        "url": "{{ url('/') }}",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "{{ url('/search?q={search_term_string}') }}",
            "query-input": "required name=search_term_string"
        }
    }
</script>

<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "CoverInsight",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "description": "Expert insurance comparisons and guides for health, auto, home and life insurance",
        "sameAs": [
            "https://www.facebook.com/coverinsight",
            "https://twitter.com/coverinsight",
            "https://www.linkedin.com/company/coverinsight"
        ]
    }
</script>
@endsection

<style>
    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .hero-section .display-5 {
            font-size: 2.2rem;
        }

        .hero-section .lead {
            font-size: 1.1rem;
        }

        .country-card .display-4 {
            font-size: 2.5rem;
        }

        .category-card .icon-wrapper {
            width: 50px;
            height: 50px;
        }
    }

    @media (max-width: 575.98px) {
        .hero-section .display-5 {
            font-size: 1.8rem;
        }

        .hero-section .btn-lg {
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }

        .country-card h3,
        .category-card h3 {
            font-size: 0.9rem;
        }
    }

    /* Hover Effects */
    .hover-shadow {
        transition: all 0.3s ease;
    }

    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .country-card,
    .category-card {
        transition: all 0.3s ease;
    }

    .country-card:hover,
    .category-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
    }

    /* Icon Wrapper */
    .icon-wrapper {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .category-card:hover .icon-wrapper {
        background-color: rgba(13, 110, 253, 0.2) !important;
        transform: scale(1.1);
    }
</style>