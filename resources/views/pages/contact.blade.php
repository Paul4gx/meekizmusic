@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="page-content bg-white">
    <!-- Banner Starts -->
<x-breadcrumb title="Contact Us" content="Feel free to reach out to us, at any time!" />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                id="subject" name="subject" value="{{ old('subject') }}" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h3 class="card-title">Other Ways to Reach Us</h3>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>Email</h5>
                            <p><a href="mailto:support@meekizmusic.com">support@meekizmusic.com</a></p>
                            <h5>Phone number</h5>
                            <p><a href="tel:+447443973717">+44(744)397-3717</a></p>
                            <h5>Office Address</h5>
                            <p>NO. 1 OSIFO STREET, OFF NOMAMIDOBO STR, EVBUOMORE QRTS, BENIN CITY, EDO STATE</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Social Media</h5>
                            <p>Follow us on social media for updates and support</p>
                            <div class="social-links">
                                <a href="#" class="me-3">Twitter</a>
                                <a href="#" class="me-3">Facebook</a>
                                <a href="#" class="me-3">Instagram</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 