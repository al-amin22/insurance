@extends('layouts.app')

@section('title', 'Terms of Use - CoverInsight')
@section('meta_description', 'Terms governing your use of our insurance research and comparison services')
@section('meta_keywords', 'insurance terms, research terms, comparison tool terms')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Terms of Use</li>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4 p-md-5">
                    <h1 class="fw-bold mb-4">Terms of Use</h1>
                    <p class="lead text-muted">By using CoverInsight, you agree to these terms governing our insurance research services.</p>

                    <div class="my-4 py-3 border-top border-bottom">
                        <h2 class="h4 fw-bold mb-3"><i class="fas fa-exclamation-triangle text-warning me-2"></i> Research Disclaimer</h2>
                        <p>Our insurance guides are based on:</p>
                        <ul class="list-styled">
                            <li>information from insurance providers</li>
                            <li>Actuarial analysis of publicly available data</li>
                            <li>calculate insurance</li>
                        </ul>
                        <div class="alert alert-warning mt-3">
                            <i class="fas fa-info-circle me-2"></i> While we strive for accuracy, insurance products change frequently. Always verify with providers.
                        </div>
                    </div>

                    <div class="my-4 py-3">
                        <h2 class="h4 fw-bold mb-3"><i class="fas fa-book-open text-primary me-2"></i> Proper Use of Research</h2>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card h-100 border-0 bg-light">
                                    <div class="card-body">
                                        <h3 class="h6 fw-bold text-primary">Allowed Uses</h3>
                                        <ul class="list-unstyled small">
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Personal education</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> information about insurance</li>
                                            <li><i class="fas fa-check-circle text-success me-2"></i> Non-commercial reference</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100 border-0 bg-light">
                                    <div class="card-body">
                                        <h3 class="h6 fw-bold text-primary">Restricted Uses</h3>
                                        <ul class="list-unstyled small">
                                            <li class="mb-2"><i class="fas fa-times-circle text-danger me-2"></i> Commercial redistribution</li>
                                            <li class="mb-2"><i class="fas fa-times-circle text-danger me-2"></i> Automated scraping</li>
                                            <li><i class="fas fa-times-circle text-danger me-2"></i> Misrepresentation</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection