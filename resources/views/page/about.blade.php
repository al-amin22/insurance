@extends('layouts.app')

@section('title', 'About CoverInsight - Your Trusted Insurance Guide')
@section('description', 'Learn about CoverInsight - our mission to simplify insurance decisions with expert comparisons, guides, and advice for health, auto, home, and life insurance.')
@section('keywords', 'about coverinsight, insurance about us, insurance mission, insurance experts, insurance comparison about')

@section('content')
<div class="about-page">
    <!-- Hero Section -->
    <section class="hero-section bg-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Simplifying Insurance Decisions Since 2020</h1>
                    <p class="lead mb-4">At CoverInsight, we're dedicated to helping you navigate the complex world of insurance with confidence.</p>
                    <a href="#our-story" class="btn btn-light btn-lg me-2">Our Story</a>
                    <a href="#our-team" class="btn btn-outline-light btn-lg">Meet Our Team</a>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('images/about-hero.jpg') }}" alt="CoverInsight team discussing insurance" class="img-fluid rounded shadow-lg" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section id="our-story" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold">Our Story</h2>
                    <div class="divider mx-auto bg-primary"></div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <img src="{{ asset('images/our-story.jpg') }}" alt="CoverInsight founding story" class="img-fluid rounded shadow" loading="lazy">
                </div>
                <div class="col-lg-6 order-lg-1 pe-lg-5">
                    <h3 class="fw-bold mb-4">From Confusion to Clarity</h3>
                    <p>Founded in 2020, CoverInsight was born out of personal frustration with the insurance industry's complexity. Our founder, after spending weeks trying to understand his family's insurance needs, realized there had to be a better way.</p>
                    <p>We set out to create a platform that would:</p>
                    <ul class="fa-ul">
                        <li class="mb-2"><span class="fa-li text-primary"><i class="fas fa-check-circle"></i></span>Demystify insurance jargon</li>
                        <li class="mb-2"><span class="fa-li text-primary"><i class="fas fa-check-circle"></i></span>Provide unbiased comparisons</li>
                        <li class="mb-2"><span class="fa-li text-primary"><i class="fas fa-check-circle"></i></span>Offer practical, actionable advice</li>
                        <li class="mb-2"><span class="fa-li text-primary"><i class="fas fa-check-circle"></i></span>Save people time and money</li>
                    </ul>
                    <p>Today, we've helped over 500,000 visitors make better insurance decisions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Values -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold">Our Mission & Values</h2>
                    <div class="divider mx-auto bg-primary"></div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-primary bg-opacity-10 text-primary mb-4">
                                <i class="fas fa-bullseye fa-2x"></i>
                            </div>
                            <h4 class="fw-bold">Our Mission</h4>
                            <p>To empower individuals and families with the knowledge and tools they need to make informed insurance decisions that protect what matters most.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-primary bg-opacity-10 text-primary mb-4">
                                <i class="fas fa-eye fa-2x"></i>
                            </div>
                            <h4 class="fw-bold">Our Vision</h4>
                            <p>A world where everyone has access to transparent, understandable insurance information that helps them secure the right coverage at the right price.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-primary bg-opacity-10 text-primary mb-4">
                                <i class="fas fa-heart fa-2x"></i>
                            </div>
                            <h4 class="fw-bold">Our Values</h4>
                            <p>Integrity, transparency, empathy, and excellence guide everything we do. We put our users' needs first, always.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Trust Us -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold">Why Trust CoverInsight?</h2>
                    <div class="divider mx-auto bg-primary"></div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="me-4 text-primary">
                            <i class="fas fa-shield-alt fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold">Unbiased Advice</h4>
                            <p>We don't sell insurance - we help you understand it. Our recommendations are based solely on what's best for you.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="me-4 text-primary">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold">Data-Driven Comparisons</h4>
                            <p>Our team analyzes thousands of policies annually to bring you the most accurate, up-to-date information.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="me-4 text-primary">
                            <i class="fas fa-user-tie fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold">Expert Team</h4>
                            <p>Our professionals average 10+ years of insurance industry experience across all major coverage types.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="me-4 text-primary">
                            <i class="fas fa-hand-holding-usd fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold">No Hidden Agenda</h4>
                            <p>We're transparent about how we make money (through advertising and referrals) and maintain strict editorial independence.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="me-4 text-primary">
                            <i class="fas fa-star fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold">Reader-First Approach</h4>
                            <p>Every article and guide is created with your needs in mind, not insurance companies'.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="me-4 text-primary">
                            <i class="fas fa-sync-alt fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold">Regular Updates</h4>
                            <p>Insurance changes constantly. We review and update our content quarterly to ensure accuracy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="display-5 fw-bold mb-4">Ready to Make Smarter Insurance Decisions?</h2>
                    <p class="lead mb-5">Join thousands of savvy consumers who trust CoverInsight for their insurance research.</p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg px-4">Explore Information Insurance</a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-lg px-4">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('styles')
<style>
    .about-page {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .hero-section {
        background: linear-gradient(135deg, #0d6efd 0%, #084298 100%);
    }

    .divider {
        width: 80px;
        height: 4px;
    }

    .icon-box {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .team-card {
        transition: transform 0.3s ease;
    }

    .team-card:hover {
        transform: translateY(-5px);
    }

    .social-links a {
        display: inline-block;
        width: 32px;
        height: 32px;
        line-height: 32px;
        text-align: center;
        border-radius: 50%;
        background-color: #f8f9fa;
        color: #0d6efd;
        margin: 0 3px;
        transition: all 0.3s ease;
    }

    .social-links a:hover {
        background-color: #0d6efd;
        color: white;
    }

    .bg-primary-dark {
        background-color: #084298;
    }

    @media (max-width: 767.98px) {
        .hero-section {
            text-align: center;
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .hero-section img {
            margin-top: 2rem;
        }
    }
</style>
@endsection
