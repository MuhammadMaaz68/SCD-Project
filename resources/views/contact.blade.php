<!-- {{-- 
    View: Contact Us
    Description: Displays contact form and information.
--}} -->
@extends('layouts.app')

@section('content')

<!-- Contact Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Contact Us</h2>
        <p class="text-center mb-5 text-muted">
            Have questions or feedback? We'd love to hear from you!  
            Fill out the form below and we'll get back to you soon.
        </p>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label fw-semibold">Message</label>
                                <textarea name="message" id="message" rows="5" class="form-control" placeholder="Write your message here..." required></textarea>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional Contact Info -->
        <div class="text-center mt-5">
            <p><i class="fas fa-envelope text-primary me-2"></i>support@bookverse.com</p>
            <p><i class="fas fa-phone text-primary me-2"></i>+1 (800) 123-4567</p>
        </div>
    </div>
</section>

@endsection