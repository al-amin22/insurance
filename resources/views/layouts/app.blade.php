<!DOCTYPE html>
<html lang="id" class="h-100">

<head>
    <meta charset="UTF-8">
    <!-- Meta Viewport untuk Responsif -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Primary Meta Tags -->
    <title>@yield('title', 'Insurance Information') – coverinsight.com</title>
    <meta name="description" content="{{ $article->description ?? 'Insurance Information, Simple Insurance, comparisons and expert tips for health, auto, home and life insurance. Get the best coverage advice for 2025.' }}">
    <meta name="keywords" content="{{ $article->keywords ?? 'Insurance Information, health insurance, car insurance, home insurance, life insurance, insurance comparison, pet insurance, travel insurance, disability insurance, leability insurance, best insurance 2025, coverage advice, tips insurance, news insurance' }}">
    <meta name="author" content="coverinsight.com">
    <meta name="theme-color" content="#0d6efd">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', $meta['og_type'] ?? 'website')">
    <meta property="og:title" content="@yield('og_title', $meta['og_title'] ?? 'Insurance Information &amp; Comparisons 2025 – coverinsight.com')">
    <meta property="og:description" content="@yield('og_description', $meta['og_description'] ?? 'Expert Insurance Information and comparisons to help you find the best coverage for your needs in 2025.')">
    <meta property="og:image" content="@yield('og_image', $meta['og_image'] ?? asset('images/og-coverinsight2025.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="coverinsight.com">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', $meta['twitter_title'] ?? 'Insurance Information &amp; Comparisons 2025 – coverinsight.com')">
    <meta name="twitter:description" content="@yield('twitter_description', $meta['twitter_description'] ?? 'Get expert advice on health, auto, home and life insurance. Compare plans and find the best coverage for 2025.')">
    <meta name="twitter:image" content="@yield('twitter_image', $meta['twitter_image'] ?? asset('images/twitter-coverinsight2025.jpg'))">
    <meta name="twitter:site" content="@coverinsight">

    <!-- Robots -->
    <meta name="robots" content="index, follow">
    <link rel="alternate" href="{{ url()->current() }}" hreflang="en" />

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}" color="#0d6efd">
    <meta name="msapplication-TileColor" content="#0d6efd">

    <!-- Structured Data -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@graph": [{
                    "@type": "WebSite",
                    "@id": "{{ url('/') }}#website",
                    "url": "{{ url('/') }}",
                    "name": "coverinsight.com",
                    "description": "Insurance Information and comparisons for health, auto, home and life coverage",
                    "publisher": {
                        "@id": "{{ url('/') }}#organization"
                    },
                    "potentialAction": {
                        "@type": "SearchAction",
                        "target": "{{ url('/search?q={search_term_string}') }}",
                        "query-input": "required name=search_term_string"
                    }
                },
                {
                    "@type": "Organization",
                    "@id": "{{ url('/') }}#organization",
                    "name": "coverinsight.com",
                    "url": "{{ url('/') }}",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "{{ asset('images/logo.png') }}"
                    },
                    "sameAs": [
                        "https://facebook.com/coverinsight",
                        "https://twitter.com/coverinsight",
                        "https://instagram.com/coverinsight"
                    ]
                },
                {
                    "@type": "CollectionPage",
                    "@id": "{{ url()->current() }}#webpage",
                    "url": "{{ url()->current() }}",
                    "name": "@yield('title', $meta['title'] ?? 'Insurance Information & Comparisons')",
                    "description": "@yield('description', $meta['description'] ?? 'Expert Insurance Information and coverage comparisons')",
                    "isPartOf": {
                        "@id": "{{ url('/') }}#website"
                    },
                    "breadcrumb": {
                        "@id": "{{ url()->current() }}#breadcrumb"
                    }
                },
                {
                    "@type": "BreadcrumbList",
                    "@id": "{{ url()->current() }}#breadcrumb",
                    "itemListElement": [{
                            "@type": "ListItem",
                            "position": 1,
                            "name": "Home",
                            "item": "{{ url('/') }}"
                        }
                        @if(request('category')), {
                            "@type": "ListItem",
                            "position": 2,
                            "name": "{{ $currentCategory->name ?? 'Category' }}",
                            "item": "{{ url()->current() }}"
                        }
                        @endif
                    ]
                }
            ]
        }
    </script>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Preload CSS untuk Performa -->
    <link rel="preload" href="{{ asset('css/app.css') }}" as="style">

    <!-- Google Ads -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9778807635336222" crossorigin="anonymous"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* CSS untuk Responsivitas */
        .floating-contact-btn {
            /* ukuran btn-sm default sudah kecil, tapi kamu bisa tweak: */
            padding: 0.25rem 0.5rem;
            /* default btn-sm adalah .25/.5 */
            font-size: 0.875rem;
            /* default btn-sm font-size */

            /* posisi tetap floating */
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }


        /* Navbar Mobile */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                padding-top: 1rem;
            }

            .navbar-nav .nav-item {
                margin-bottom: 0.5rem;
            }

            .search-form-mobile {
                margin-top: 1rem;
            }
        }

        /* Footer Mobile */
        @media (max-width: 767.98px) {

            .footer .col-md-4,
            .footer .col-md-2 {
                margin-bottom: 1.5rem;
            }

            .footer-text {
                text-align: center;
            }
        }

        /* Breadcrumb Mobile */
        @media (max-width: 575.98px) {
            .breadcrumb {
                font-size: 0.85rem;
                white-space: nowrap;
                overflow-x: auto;
                flex-wrap: nowrap;
                padding-bottom: 0.5rem;
            }
        }
    </style>
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Z7WB1M5J0T"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-Z7WB1M5J0T');
</script>

<body class="d-flex flex-column h-100">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXXXXX"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}" aria-label="coverinsight.com Home">Insurance Information</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarCountries" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-globe me-1"></i> Countries
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarCountries">
                                <li><a class="dropdown-item" href="{{ route('articles.by_country', 'us') }}">United States</a></li>
                                <li><a class="dropdown-item" href="{{ route('articles.by_country', 'gb') }}">United Kingdom</a></li>
                                <li><a class="dropdown-item" href="{{ route('articles.by_country', 'ca') }}">Canada</a></li>
                                <li><a class="dropdown-item" href="{{ route('articles.by_country', 'au') }}">Australia</a></li>
                                <li><a class="dropdown-item" href="{{ route('articles.by_country', 'de') }}">Germany</a></li>
                                <li><a class="dropdown-item" href="{{ route('articles.by_country', 'jp') }}">Japan</a></li>
                            </ul>
                        </li>
                        @foreach($mainCategories ?? [] as $category)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.show', ['country' => 'us', 'slug' => $category->slug]) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="d-flex flex-column flex-lg-row gap-2 my-2 my-lg-0">
                        <a href="{{ route('contact') }}" class="btn btn-outline-light-sm">
                            <i class="fas fa-envelope me-1"></i> <span class="d-lg-inline">Contact</span>
                        </a>
                        <form class="d-flex search-form-mobile" action="{{ route('search') }}" method="GET">
                            <div class="input-group">
                                <input class="form-control"
                                    type="search"
                                    name="q"
                                    value="{{ request('q') }}"
                                    placeholder="Search insurance..."
                                    aria-label="Search insurance"
                                    required
                                    minlength="3">
                                <button class="btn btn-light" type="submit" aria-label="Search">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Breadcrumb -->
        @hasSection('breadcrumb')
        <div class="bg-light py-2">
            <div class="container">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb mb-0">
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>
        </div>
        @endif
    </header>

    <!-- Main Content -->
    <main class="flex-shrink-0">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto bg-dark text-white pt-4 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h2 class="h5 fw-bold">Insurance Information</h2>
                    <p>Your trusted resource for insurance information and calculate your insurance.</p>
                    <div class="social-icons">
                        <a href="#" class="text-white me-2" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-2" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-2" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-white" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <h2 class="h5 fw-bold">Countries</h2>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('articles.by_country', 'us') }}" class="text-white-50">United States</a></li>
                        <li><a href="{{ route('articles.by_country', 'gb') }}" class="text-white-50">United Kingdom</a></li>
                        <li><a href="{{ route('articles.by_country', 'ca') }}" class="text-white-50">Canada</a></li>
                        <li><a href="{{ route('articles.by_country', 'au') }}" class="text-white-50">Australia</a></li>
                        <li><a href="{{ route('articles.by_country', 'de') }}" class="text-white-50">Germany</a></li>
                        <li><a href="{{ route('articles.by_country', 'jp') }}" class="text-white-50">Japan</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-3">
                    <h2 class="h5 fw-bold">Legal</h2>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('privacy') }}" class="text-white-50">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}" class="text-white-50">Terms of Use</a></li>
                        <li><a href="{{ route('licensing') }}" class="text-white-50">Licensing</a></li>
                        <li><a href="{{ route('dmca') }}" class="text-white-50">DMCA</a></li>
                        <li><a href="{{ route('contact') }}" class="text-white-50">Contact Us</a></li>
                        <li><a href="{{ route('about') }}" class="text-white-50">About</a></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-3">
                    <h2 class="h5 fw-bold">Newsletter</h2>
                    <p>Subscribe to get insurance tips and updates</p>
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('newsletter.subscribe') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Your E-mail" required aria-label="Email for newsletter">
                        </div>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>
                    <small class="text-white-50">We'll never share your email with anyone else.</small>
                </div>
            </div>
            <hr class="my-3 bg-secondary">
            <div class="row">
                <div class="col-md-6 text-center text-md-start footer-text">
                    <small>&copy; {{ date('Y') }} coverinsight.com. All rights reserved.</small>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <small>
                        <a href="{{ route('privacy') }}" class="text-white-50 me-2">Privacy Policy</a>
                        <a href="{{ route('terms') }}" class="text-white-50 me-2">Terms of Service</a>
                        <a href="/contact" class="text-white-50">Contact Us</a>
                    </small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('scripts')

    <!-- Floating Contact Button -->
    <a href="{{ route('contact') }}" class="btn btn-primary rounded-circle p-3 floating-contact-btn" aria-label="Contact Us">
        <i class="fas fa-headset fa-lg"></i>
    </a>
</body>

</html>