@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="page-content bg-white">
    <!-- Banner Starts -->
<x-breadcrumb title="Who We Are" content="Learn More about us and understand why we only give the best!" />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="mb-4">About Meekizmusic</h1>
            
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">Our Story</h2>
                    <p class="card-text">
                        Meekizmusic is your premier destination for high-quality music beats. We connect talented producers 
                        with artists, providing a platform where creativity meets opportunity.
                    </p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Our Mission</h3>
                            <p class="card-text">
                                To empower musicians and producers by providing a reliable platform for buying and selling 
                                high-quality beats, fostering musical creativity and collaboration.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Our Vision</h3>
                            <p class="card-text">
                                To become the world's leading marketplace for music beats, known for quality, 
                                reliability, and fostering a thriving community of musicians.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Why Choose Us?</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3">✓ Curated selection of high-quality beats</li>
                        <li class="mb-3">✓ Secure transactions and licensing</li>
                        <li class="mb-3">✓ Direct communication with producers</li>
                        <li class="mb-3">✓ Competitive pricing</li>
                        <li>✓ 24/7 customer support</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection 