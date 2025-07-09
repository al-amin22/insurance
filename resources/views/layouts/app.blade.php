<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Comprehensive insurance guides, comparisons and tips for health, auto, home and life insurance')">
    <meta name="keywords" content="@yield('meta_keywords', 'insurance, health insurance, car insurance, home insurance, life insurance, insurance comparison')">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}" />
    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,
    %3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E
    %3Cpath fill='%230d6efd' d='M32 2C18 10 6 14 6 26s10 30 26 36c16-6 26-24 26-36S46 10 32 2z'/%3E
    %3Cpath fill='white' d='M32 18a8 8 0 0 1 8 8h-4a4 4 0 0 0-8 0c0 4 8 4 8 10v2h-4v-2c0-2-8-2-8-10a8 8 0 0 1 8-8z'/%3E
    %3C/svg%3E" type="image/svg+xml">


    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Insurance Guides - coverinsight.com')">
    <meta property="og:description" content="@yield('meta_description', 'Comprehensive insurance guides and comparisons')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Insurance Guides - coverinsight.com')">
    <meta property="twitter:description" content="@yield('meta_description', 'Comprehensive insurance guides and comparisons')">
    <meta property="twitter:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    <title>@yield('title', 'Insurance Guides - coverinsight.com')"></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Schema.org markup for Google -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "Insurance Guides",
            "url": "{{ url('/') }}",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "{{ url('/search') }}?q={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
    </script>

    @yield('head')
</head>

<body class="d-flex flex-column h-100">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXXXXX"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">Insurance Information</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarCountries" data-bs-toggle="dropdown">
                                <i class="fas fa-globe me-1"></i> Countries
                            </a>
                            <ul class="dropdown-menu">
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
                    <a href="{{ route('contact') }}" class="btn btn-outline-light me-2">
                        <i class="fas fa-envelope me-1"></i> Contact
                    </a>
                    <form class="d-flex" action="{{ route('search') }}" method="GET">
                        <div class="input-group">
                            <input class="form-control"
                                type="search"
                                name="q"
                                value="{{ request('q') }}"
                                placeholder="Search insurance..."
                                aria-label="Search"
                                required
                                minlength="3">
                            <button class="btn btn-light" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Breadcrumb -->
        @hasSection('breadcrumb')
        <div class="bg-light py-2">
            <div class="container">
                <nav aria-label="breadcrumb">
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
                    <h5 class="fw-bold">Insurance Guides</h5>
                    <p>Your trusted resource for insurance information and calculate your insurance.</p>
                    <div class="social-icons">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <h5 class="fw-bold">Countries</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('articles.by_country', 'us') }}" class="text-white-50">United States</a></li>
                        <li><a href="{{ route('articles.by_country', 'gb') }}" class="text-white-50">United Kingdom</a></li>
                        <li><a href="{{ route('articles.by_country', 'ca') }}" class="text-white-50">Canada</a></li>
                        <li><a href="{{ route('articles.by_country', 'au') }}" class="text-white-50">Australia</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-3">
                    <h5 class="fw-bold text-white">Legal</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('privacy') }}" class="text-white-50">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}" class="text-white-50">Terms of Use</a></li>
                        <li><a href="{{ route('licensing') }}" class="text-white-50">Licensing</a></li>
                        <li><a href="{{ route('dmca') }}" class="text-white-50">DMCA</a></li>
                    </ul>
                </div>


                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Newsletter</h5>
                    <p>Subscribe to get insurance tips and updates</p>
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('newsletter.subscribe') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Your E-mail" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>
                    <small class="text-white-50">We'll never share your email with anyone else.</small>
                </div>
            </div>
            <hr class="my-3 bg-secondary">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <small>&copy; {{ date('Y') }} coverinsight.com'. All rights reserved.</small>
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

    <!-- B2025 coverinsight.comootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')
    <!-- Before closing </body> tag -->
    <a href="{{ route('contact') }}" class="btn btn-primary rounded-circle p-3 floating-contact-btn">
        <i class="fas fa-headset fa-lg"></i>
    </a>

    <style>
        .floating-contact-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
    </style>
</body>

</html>