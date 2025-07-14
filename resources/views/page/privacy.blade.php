@extends('layouts.app')

@section('title', 'Privacy Policy')
@section('meta_description', 'How we protect your information while providing insurance research and comparison services')
@section('meta_keywords', 'insurance privacy policy, data protection insurance, insurance data security')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4 p-md-5">
                    <h1 class="fw-bold mb-4">Privacy Policy</h1>
                    <p class="lead text-muted">Your privacy matters to us at CoverInsight. As insurance researchers, we handle your data with the same care we recommend for your insurance coverage.</p>

                    <div class="my-4 py-3 border-top border-bottom">
                        <h2 class="h4 fw-bold mb-3"><i class="fas fa-database text-primary me-2"></i> Insurance Data Collection</h2>
                        <p>We collect information to provide accurate insurance comparisons and research insights:</p>
                        <ul class="list-styled">
                            <li><strong>Research Data:</strong> Anonymous usage patterns to improve our insurance guides</li>
                            <li><strong>Contact Information:</strong> Only when you request personalized insurance analysis</li>
                            <li><strong>Cookies:</strong> Used to enhance your experience with our insurance tools</li>
                        </ul>
                    </div>

                    <div class="my-4 py-3">
                        <h2 class="h4 fw-bold mb-3"><i class="fas fa-chart-line text-primary me-2"></i> Data Usage</h2>
                        <p>As actuarial researchers, we utilize data to:</p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-check-circle text-success me-2"></i> give information about insurance products
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-check-circle text-success me-2"></i> give you personalized insurance recommendations
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-check-circle text-success me-2"></i> Develop research methodologies
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-check-circle text-success me-2"></i> calculate insurance risks
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-check-circle text-success me-2"></i> Identify market trends in insurance
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mt-4">
                        <div class="d-flex">
                            <i class="fas fa-shield-alt fa-2x me-3 text-primary"></i>
                            <div>
                                <h3 class="h5 fw-bold mb-2">Insurance-Grade Protection</h3>
                                <p class="mb-0">We apply the same risk management principles to data security that we research in insurance products.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection