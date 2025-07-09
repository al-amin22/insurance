@extends('layouts.app')

@section('title', 'Insurance Guides for ' . strtoupper($country) . ' - SoundEffectsFree.com')
@section('meta_description', 'Comprehensive insurance guides and comparisons for ' . strtoupper($country) . '. Find the best coverage options in your country.')
@section('meta_keywords', strtolower($country) . ' insurance, ' . strtolower($country) . ' insurance guides, insurance in ' . strtolower($country))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ strtoupper($country) }} Insurance</li>
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Country Header -->
            <header class="mb-5">
                <h1 class="fw-bold mb-3">Insurance Guides for {{ strtoupper($country) }}</h1>
                <p class="lead">Find the best insurance options and coverage details specific to {{ strtoupper($country) }}.</p>
            </header>

            <!-- Categories List -->
            <section class="mb-5">
                <h2 class="h4 fw-bold mb-4 pb-2 border-bottom">Browse by Category</h2>
                <div class="row g-4">
                    @foreach($categories as $category)
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <a href="{{ route('categories.show', ['country' => $country, 'slug' => $category->slug]) }}" class="text-decoration-none">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        @php
                                        $icon = match(true) {
                                        str_contains(strtolower($category->name), 'health') => 'fas fa-heartbeat',
                                        str_contains(strtolower($category->name), 'auto') || str_contains(strtolower($category->name), 'car') => 'fas fa-car',
                                        str_contains(strtolower($category->name), 'home') => 'fas fa-home',
                                        str_contains(strtolower($category->name), 'life') => 'fas fa-shield-alt',
                                        str_contains(strtolower($category->name), 'travel') => 'fas fa-plane',
                                        str_contains(strtolower($category->name), 'pet') => 'fas fa-paw',
                                        default => 'fas fa-file-alt'
                                        };
                                        @endphp
                                        <div class="icon-wrapper d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle me-3" style="width: 50px; height: 50px;">
                                            <i class="{{ $icon }} fs-5"></i>
                                        </div>

                                        <div>
                                            <h3 class="h6 mb-1">{{ $category->name }}</h3>
                                            <small class="text-muted">{{ $category->articles_count }} guides</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- Latest Articles -->
            <section class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 fw-bold mb-0">Latest Insurance Guides</h2>
                    <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                </div>

                <div class="row g-4">
                    @foreach($latestArticles as $article)
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <a href="{{ route('articles.show', [
                                'country' => $country,
                                'category_slug' => $article->category->slug,
                                'article_slug' => $article->slug
                            ]) }}" class="text-decoration-none">
                                @if($article->image_path)
                                <img src="{{ asset($article->image_path) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 180px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge bg-primary me-2">{{ strtoupper($country) }}</span>
                                        <small class="text-muted">{{ $article->category->name }}</small>
                                    </div>
                                    <h3 class="h6 card-title">{{ $article->title }}</h3>
                                    <p class="card-text text-muted small">{{ Str::limit($article->description, 80) }}</p>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pt-0">
                                    <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 20px;">
                <!-- Country Insurance Info -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="h6 mb-0">Insurance in {{ strtoupper($country) }}</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Learn about insurance regulations, requirements, and market trends specific to {{ strtoupper($country) }}.</p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Legal requirements</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Average costs</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Top providers</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i> Consumer protections</li>
                        </ul>
                    </div>
                </div>

                <!-- Popular Articles -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="h6 mb-0">Most Popular</h3>
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach($popularArticles as $article)
                        <a href="{{ route('articles.show', [
                                'country' => $country,
                                'category_slug' => $article->category->slug,
                                'article_slug' => $article->slug
                            ]) }}" class="list-group-item list-group-item-action">

                            <div class="d-flex align-items-center">
                                @if($article->image_path)
                                <img src="{{ asset($article->image_path) }}" class="rounded me-3" width="60" height="60" alt="{{ $article->title }}">
                                @endif
                                <div>
                                    <h4 class="h6 mb-1">{{ Str::limit($article->title, 50) }}</h4>
                                    <small class="text-muted">{{ $article->visit_count }} views</small>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Compare Tools -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h3 class="h6 mb-0">Insurance Premium Calculator</h3>
                    </div>
                    <div class="card-body">
                        <form id="insurance-calculator">
                            <div class="mb-3">
                                <label for="insuranceType" class="form-label small">Insurance Type</label>
                                <select id="insuranceType" class="form-select form-select-sm">
                                    @foreach($categories as $category)
                                    <option value="{{ strtolower($category->name) }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="age" class="form-label small">Your Age</label>
                                <input type="number" id="age" class="form-control form-control-sm" placeholder="e.g. 30" min="18" max="100">
                            </div>

                            <div class="mb-3">
                                <label for="coverage" class="form-label small">Coverage Amount ($)</label>
                                <input type="number" id="coverage" class="form-control form-control-sm" placeholder="e.g. 100000" step="1000">
                            </div>

                            <div class="d-grid">
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="calculatePremium()">Calculate Premium</button>
                            </div>

                            <div id="result" class="alert alert-success mt-3 d-none small"></div>
                        </form>
                    </div>
                </div>

                {{-- Optional: Tombol cepat kategori --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light">
                        <h3 class="h6 mb-0">Quick Select Insurance Type</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($categories as $category)
                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                onclick="document.getElementById('insuranceType').value = '{{ strtolower($category->name) }}'">
                                {{ $category->name }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function calculatePremium() {
        const type = document.getElementById('insuranceType').value;
        const age = parseInt(document.getElementById('age').value);
        const coverage = parseFloat(document.getElementById('coverage').value);
        const result = document.getElementById('result');

        if (isNaN(age) || isNaN(coverage)) {
            result.classList.remove('d-none');
            result.classList.add('alert-danger');
            result.classList.remove('alert-success');
            result.innerText = 'Please enter valid age and coverage amount.';
            return;
        }

        // Simple logic: base + (age * rate) + (coverage factor)
        let base = 10;
        let ageFactor = age * 0.5;
        let coverageFactor = coverage / 10000;

        let typeMultiplier = {
            'health': 1.2,
            'auto': 1.1,
            'life': 1.5,
            'travel': 0.9,
            'pet': 0.8
        };

        let premium = (base + ageFactor + coverageFactor) * (typeMultiplier[type] || 1);
        premium = premium.toFixed(2);

        result.classList.remove('d-none');
        result.classList.remove('alert-danger');
        result.classList.add('alert-success');
        result.innerHTML = `Estimated Monthly Premium: <strong>$${premium}</strong>`;
    }
</script>

@endsection