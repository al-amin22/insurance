@extends('layouts.app')

@section('title', 'Insurance Information &amp; Simple Insurance 2025')
@section('meta_description', 'Trusted insurance guides for health, auto, home, and life insurance in US, UK, Canada, Australia, Germany & Japan. Expert comparisons to help you save.')
@section('meta_keywords', 'insurance guide, compare insurance, health insurance, car insurance, home insurance, life insurance, insurance tips, US insurance, UK insurance, Canada insurance')

@section('content')
<!-- Hero Section with Insurance Focus -->
<section class="hero-section bg-primary text-white py-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-4 fw-bold mb-3">Insurance Made Simple</h1>
                <p class="lead mb-4">Data-driven insurance comparisons and expert guides to help you find optimal coverage in the US, UK, Canada, Australia, Germany, and Japan.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('articles.by_country', 'us') }}" class="btn btn-light btn-lg px-4">
                        Country Insurance <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <a href="#popular-categories" class="btn btn-outline-light btn-lg px-4">
                        Insurance Types
                    </a>
                </div>
                <div class="mt-4">
                    <span class="badge bg-white text-primary me-2">Trusted Research</span>
                    <span class="badge bg-white text-primary">Updated Daily</span>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/erasebg-transformed.png') }}" alt="Insurance Comparison Guide" class="img-fluid rounded shadow" loading="lazy" width="600" height="400">
            </div>
        </div>
    </div>
</section>

<!-- Featured Insurance Comparisons -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 fw-bold mb-0">Latest Insurance Comparisons</h2>
            <a href="{{ route('articles.by_country', 'us') }}" class="btn btn-sm btn-outline-primary">
                View All Guides <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($popularArticles as $article)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow transition">
                    <a href="{{ route('articles.show', [
                        'country' => strtolower($article->country),
                        'category_slug' => $article->category->slug,
                        'article_slug' => $article->slug
                    ]) }}" aria-label="{{ $article->title }}">
                        @if($article->image_path)
                        <img src="{{ asset($article->image_path) }}" class="card-img-top" alt="{{ $article->title }} insurance guide" style="height: 200px; object-fit: cover;" loading="lazy" width="400" height="200">
                        @endif
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-primary me-2">{{ strtoupper($article->country) }}</span>
                                <small class="text-muted">{{ $article->category->name }}</small>
                            </div>
                            <h3 class="h5 card-title">{{ $article->title }}</h3>
                            <p class="card-text text-muted">{{ Str::limit($article->description, 100) }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                                <small class="text-muted"><i class="fas fa-eye me-1"></i> {{ number_format($article->visit_count) }} views</small>
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
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 h3 fw-bold">Country-Specific Insurance Guides</h2>
        <p class="text-center mb-4 text-muted">Select your country for localized insurance information and regulations</p>

        <div class="row g-4 justify-content-center">
            @php
            $countries = [
            'us' => ['name' => 'United States', 'flag' => '🇺🇸', 'desc' => 'Health, auto & home insurance guides'],
            'gb' => ['name' => 'United Kingdom', 'flag' => '🇬🇧', 'desc' => 'NHS, car & home insurance'],
            'ca' => ['name' => 'Canada', 'flag' => '🇨🇦', 'desc' => 'Provincial health & auto insurance'],
            'au' => ['name' => 'Australia', 'flag' => '🇦🇺', 'desc' => 'Medicare & private health insurance'],
            'de' => ['name' => 'Germany', 'flag' => '🇩🇪', 'desc' => 'German health & liability insurance'],
            'jp' => ['name' => 'Japan', 'flag' => '🇯🇵', 'desc' => 'Shakai Hoken & Japanese auto insurance']
            ];
            $chunks = array_chunk($countries, 3, true);
            @endphp

            @foreach($countries as $code => $country)
            <div class="col-6 col-md-2">
                <a href="{{ route('articles.by_country', $code) }}" class="card country-card text-center border-0 shadow-sm h-100 text-decoration-none" aria-label="{{ $country['name'] }} insurance guides">
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
<section id="popular-categories" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 h3 fw-bold">Insurance Types We Cover</h2>
        <p class="text-center mb-4 text-muted">Comprehensive guides for all major insurance categories</p>

        <div class="row g-4">
            @foreach($categories->chunk(3) as $chunk)
            @foreach($chunk as $category)
            <div class="col-6 col-md-2">
                <a href="{{ route('categories.show', ['country' => 'us', 'slug' => $category->slug]) }}"
                    class="card category-card border-0 shadow-sm h-100 text-decoration-none" aria-label="{{ $category->name }} insurance guides">
                    <div class="card-body text-center">
                        @php
                        $icon = match(true) {
                        str_contains(strtolower($category->name), 'health') => 'fas fa-heartbeat',
                        str_contains(strtolower($category->name), 'auto') || str_contains(strtolower($category->name), 'car') => 'fas fa-car',
                        str_contains(strtolower($category->name), 'home') || str_contains(strtolower($category->name), 'property') => 'fas fa-home',
                        str_contains(strtolower($category->name), 'life') => 'fas fa-shield-alt',
                        str_contains(strtolower($category->name), 'travel') => 'fas fa-plane',
                        str_contains(strtolower($category->name), 'pet') => 'fas fa-paw',
                        str_contains(strtolower($category->name), 'business') => 'fas fa-briefcase',
                        str_contains(strtolower($category->name), 'liability') => 'fas fa-balance-scale',
                        str_contains(strtolower($category->name), 'disability') => 'fas fa-wheelchair',
                        str_contains(strtolower($category->name), 'comparison') => 'fas fa-exchange-alt',
                        str_contains(strtolower($category->name), 'tips') => 'fas fa-lightbulb',
                        str_contains(strtolower($category->name), 'news') => 'fas fa-newspaper',
                        default => 'fas fa-file-alt'
                        };
                        @endphp
                        <div class="icon-wrapper bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-3" style="width: 60px; height: 60px; line-height: 60px;">
                            <i class="{{ $icon }} fs-4"></i>
                        </div>
                        <h3 class="h6 mb-1">{{ $category->name }}</h3>
                        <small class="text-muted">{{ $category->articles_count }} expert guides</small>
                    </div>
                </a>
            </div>
            @endforeach
            @endforeach
        </div>
    </div>
</section>

<!-- Trust Signals & CTA -->
<!-- <section class="py-5 bg-white">
    <div class="container text-center py-4">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <h2 class="h1 fw-bold mb-4">Why Trust CoverInsight?</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="p-4">
                            <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
                            <h3 class="h5">Data-Driven</h3>
                            <p class="text-muted small">Our comparisons are based on actual market research and pricing data</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4">
                            <i class="fas fa-user-tie fa-3x text-primary mb-3"></i>
                            <h3 class="h5">Expert Reviewed</h3>
                            <p class="text-muted small">All content is reviewed by licensed insurance professionals</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4">
                            <i class="fas fa-sync-alt fa-3x text-primary mb-3"></i>
                            <h3 class="h5">Regularly Updated</h3>
                            <p class="text-muted small">We update our guides quarterly to reflect current market conditions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-primary text-white p-5 rounded-3 shadow-sm">
            <h2 class="h2 fw-bold mb-4">Ready to Find Better Insurance?</h2>
            <p class="lead mb-5 opacity-75">Start with our expert-curated guides to make informed decisions about your coverage.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('articles.by_country', 'us') }}" class="btn btn-light btn-lg px-4">
                    Get Started Now <i class="fas fa-arrow-right ms-2"></i>
                </a>
                <a href="/about" class="btn btn-outline-light btn-lg px-4">
                    Our Methodology
                </a>
            </div>
        </div>
    </div>
</section> -->

<!-- Schema.org markup -->
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "CoverInsight - Insurance Guides & Comparisons",
        "url": "https://coverinsight.com",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "https://coverinsight.com/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
</script>

<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "CoverInsight",
        "url": "https://coverinsight.com",
        "logo": "https://coverinsight.com/images/logo.png",
        "description": "Expert insurance comparisons and guides for health, auto, home and life insurance",
        "sameAs": [
            "https://www.facebook.com/coverinsight",
            "https://twitter.com/coverinsight",
            "https://www.linkedin.com/company/coverinsight"
        ]
    }
</script>
@endsection