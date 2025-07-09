@extends('layouts.app')

@section('title', 'DMCA Policy - CoverInsight')
@section('meta_description', 'Copyright protection for our original insurance research content')
@section('meta_keywords', 'insurance content copyright, DMCA insurance research, protect insurance articles')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">DMCA Policy</li>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4 p-md-5">
                    <h1 class="fw-bold mb-4">DMCA Policy</h1>
                    <p class="lead text-muted">Protecting our original insurance research and analysis.</p>

                    <div class="my-4 py-3 border-top border-bottom">
                        <h2 class="h4 fw-bold mb-3"><i class="fas fa-copyright text-primary me-2"></i> Original Research Protection</h2>
                        <p>All CoverInsight content represents:</p>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="text-center p-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-2" style="width: 60px; height: 60px; line-height: 60px;">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                    <p class="mb-0 small fw-bold">Actuarial Analysis</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-2" style="width: 60px; height: 60px; line-height: 60px;">
                                        <i class="fas fa-balance-scale"></i>
                                    </div>
                                    <p class="mb-0 small fw-bold">Proprietary Methods</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-2" style="width: 60px; height: 60px; line-height: 60px;">
                                        <i class="fas fa-lightbulb"></i>
                                    </div>
                                    <p class="mb-0 small fw-bold">Unique Insights</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="my-4 py-3">
                        <h2 class="h4 fw-bold mb-3"><i class="fas fa-flag text-danger me-2"></i> Reporting Copyright Issues</h2>
                        <div class="card border-danger">
                            <div class="card-header bg-danger text-white">
                                <h3 class="h6 mb-0">Notice Requirements</h3>
                            </div>
                            <div class="card-body">
                                <ol class="list-styled">
                                    <li class="mb-2">Identify the specific content in question</li>
                                    <li class="mb-2">Provide your contact information</li>
                                    <li class="mb-2">Include a statement of good faith belief</li>
                                    <li>Your physical or electronic signature</li>
                                </ol>
                                <div class="mt-3 p-3 bg-light rounded">
                                    <h4 class="h6 fw-bold mb-2"><i class="fas fa-envelope me-2"></i> Submit Notice To:</h4>
                                    <p class="mb-1 fw-bold">legal@coverinsight.com</p>
                                    <small class="text-muted">We typically respond within 2 business days</small>
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