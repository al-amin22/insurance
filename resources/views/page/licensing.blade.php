@extends('layouts.app')

@section('title', 'Content Licensing & Attribution - CoverInsight')
@section('meta_description', 'Information about third-party resources used in our insurance research and how to properly cite our work')
@section('meta_keywords', 'insurance research attribution, content licensing, research methodology')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Content Licensing</li>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4 p-md-5">
                    <h1 class="fw-bold mb-4">Content Licensing & Attribution</h1>
                    <p class="lead text-muted">Transparent disclosure of resources used in our insurance research.</p>

                    <div class="my-4 py-3 border-top border-bottom">
                        <h2 class="h4 fw-bold mb-3"><i class="fas fa-external-link-alt text-primary me-2"></i> Third-Party Resources</h2>
                        <p>We attribute all external resources used in our research:</p>
                        <ul class="list-styled">
                            <li class="mb-2">
                                <strong>Icons:</strong> Font Awesome (version 6.4.0) under <a href="https://fontawesome.com/license" target="_blank">Font Awesome Free License</a>
                                <div class="ms-4 mt-1 small text-muted">
                                    <i class="fab fa-font-awesome me-1"></i> Used for interface elements and visual indicators
                                </div>
                            </li>
                            <li class="mb-2">
                                <strong>Images:</strong> Photos from <a href="https://unsplash.com" target="_blank">Unsplash</a> under Unsplash License
                                <div class="ms-4 mt-1 small text-muted">
                                    <i class="fas fa-camera me-1"></i> Used for article headers and visual enhancements
                                </div>
                            </li>
                            <li>
                                <strong>Government Data:</strong> Public domain information with proper attribution
                                <div class="ms-4 mt-1 small text-muted">
                                    <i class="fas fa-landmark me-1"></i> Cited with original source references
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="my-4 py-3">
                        <h2 class="h4 fw-bold mb-3"><i class="fas fa-microscope text-primary me-2"></i> Original Research Methodology</h2>
                        <p>Our insurance analysis is independently developed through:</p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="card h-100 border-0 bg-light">
                                    <div class="card-body">
                                        <h3 class="h6 fw-bold text-primary">Academic Research</h3>
                                        <ul class="list-unstyled small">
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Peer-reviewed actuarial studies</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Insurance industry white papers</li>
                                            <li><i class="fas fa-check-circle text-success me-2"></i> Statistical analysis of claims data</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100 border-0 bg-light">
                                    <div class="card-body">
                                        <h3 class="h6 fw-bold text-primary">Field Research</h3>
                                        <ul class="list-unstyled small">
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Policy documentation analysis</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Provider interviews</li>
                                            <li><i class="fas fa-check-circle text-success me-2"></i> Market rate comparisons</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning mt-4">
                        <div class="d-flex">
                            <i class="fas fa-exclamation-triangle fa-2x me-3 text-warning"></i>
                            <div>
                                <h3 class="h5 fw-bold mb-2">Copyright Notice</h3>
                                <p class="mb-1">All original research content is protected under copyright law.</p>
                                <p class="mb-0">If you believe content on this site violates your copyright, please <a href="/dmca" class="alert-link">contact us</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection