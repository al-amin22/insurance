@extends('layouts.app')

@section('title', 'Contact Our Insurance Experts')
@section('meta_description', 'Get in touch with our insurance researchers for questions about coverage, comparisons, or partnerships')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0">Contact Our Insurance Team</h1>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-12">
                                <label for="subject" class="form-label">Subject</label>
                                <select class="form-select" id="subject" name="subject" required>
                                    <option value="" selected disabled>Select a topic</option>
                                    <option value="Insurance Question">Insurance Question</option>
                                    <option value="Research Partnership">Research Partnership</option>
                                    <option value="Data Licensing">Data Licensing</option>
                                    <option value="Website Feedback">Website Feedback</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Your Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-paper-plane me-2"></i> Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h2 class="h5">
                                    <i class="fas fa-globe text-primary me-2"></i> Our Office
                                </h2>
                                <p class="mb-0">We operate fully online to serve users worldwide — no physical office required.</p>
                                <p class="mb-0">Feel free to contact us anytime via our <a href="{{ route('contact') }}" class="text-primary text-decoration-underline">contact form</a> or email.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h2 class="h5"><i class="fas fa-clock text-primary me-2"></i> Research Hours</h2>
                                <p class="mb-2"><strong>Monday-Friday:</strong> 9:00 AM - 5:00 PM</p>
                                <p class="mb-0"><strong>Weekends:</strong> Closed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection