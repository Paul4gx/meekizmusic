@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
<div class="admin-orders">
    <div class="admin-card">
        <div class="admin-card-header">
            <h4>Order Details #{{ $order->id }}</h4>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
        <div class="admin-card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="admin-info-card">
                        <h5>Order Information</h5>
                        <table class="table">
                            <tr>
                                <th>Order ID:</th>
                                <td>#{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <th>Date:</th>
                                <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Amount:</th>
                                <td>${{ number_format($order->amount, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="admin-info-card">
                        <h5>Customer Information</h5>
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $order->user->profile_photo_url }}" alt="{{ $order->user->name }}" class="admin-user-avatar me-3">
                            <div>
                                <h6 class="mb-0">{{ $order->user->name }}</h6>
                                <p class="mb-0">{{ $order->user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="admin-info-card">
                        <h5>Beat Information</h5>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/' . $order->beat->cover_image) }}" alt="{{ $order->beat->title }}" class="admin-beat-cover me-3">
                            <div>
                                <h6 class="mb-1">{{ $order->beat->title }}</h6>
                                <p class="mb-1">{{ $order->beat->genre }}</p>
                                <p class="mb-0">{{ $order->beat->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="admin-info-card">
                        <h5>Update Status</h5>
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update Status
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 