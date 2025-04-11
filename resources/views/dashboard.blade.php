@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ Auth::user()->profile_image ?? asset('images/default-avatar.jpg') }}" 
                            class="rounded-circle mb-3" alt="Profile Image" style="width: 100px; height: 100px; object-fit: cover;">
                        <h5 class="card-title mb-0">{{ Auth::user()->name }}</h5>
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                    </div>

                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action active">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-shopping-cart me-2"></i> My Orders
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-heart me-2"></i> Wishlist
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-download me-2"></i> Downloads
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-user-edit me-2"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">Recent Orders</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="text-center">No orders found</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Account Details</h4>
                            <p class="mb-1"><strong>Name:</strong> {{ Auth::user()->name }}</p>
                            <p class="mb-1"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p class="mb-1"><strong>Phone:</strong> {{ Auth::user()->phone_number ?? 'Not set' }}</p>
                            <p class="mb-0"><strong>Member Since:</strong> {{ Auth::user()->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Shipping Address</h4>
                            @if(Auth::user()->address)
                                <p class="mb-1">{{ Auth::user()->address }}</p>
                                <p class="mb-1">{{ Auth::user()->state }}, {{ Auth::user()->postal_code }}</p>
                                <p class="mb-0">{{ Auth::user()->country }}</p>
                            @else
                                <p class="mb-0">No shipping address set</p>
                            @endif
                            <a href="#" class="btn btn-sm btn-outline-primary mt-3">Update Address</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 