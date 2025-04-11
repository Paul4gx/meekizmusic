@extends('layouts.auth')
@section('title', 'My Orders')
@section('content')
<section class="content-inner-2 pt-0">
    <div class="container">
        <div class="row dz-tooltip-blog wow fadeInUp" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
            @forelse($orders as $order)
            <div class="col-12">
                <div class="dz-card style-4 image-tooltip-effect" data-url="assets/images/blog/grid3/pic1.jpg">
                    <div class="row dz-info justify-content-between">
                        <div class="col-lg-2">
                            <h5 class="dz-title"><a href="blog-details.html">{{ $order->created_at->format('M d, Y') }}</a></h5>
                            <span class="small-title">pm</span>
                        </div>
                        <div class="col-lg-3">
                            <h5 class="dz-title"><a href="blog-details.html">{{ $order->beat->title }}</a></h5>
                        </div>
                        <div class="col-lg-2">
                            <h5 class="dz-title"><a href="blog-details.html">${{ number_format($order->amount, 2) }}</a></h5>
                            <span class="small-title">Music Director</span>
                        </div>
                        <div class="col-lg-2">
                            <h5 class="dz-title"><a href="blog-details.html">Dallas</a></h5>
                            <span class="small-title">Black Rock Club</span>
                        </div>
                        <div class="col-lg-1">
                            <a href="{{ route('purchased.download', $order) }}" class="btn-link text-secondary"><i class="la la-arrow-down"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
                <div class="text-center">No recent purchases.</div>
        @endforelse 
        </div>


                    {{-- @forelse($orders as $order)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $order->beat->cover_image) }}" alt="{{ $order->beat->title }}" class="dz-beat-cover me-2">
                                    {{ $order->beat->title }}
                                </div>
                            </td>
                            <td>${{ number_format($order->amount, 2) }}</td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                @if($order->status === 'completed')
                                    <a href="{{ route('purchased.download', $order) }}" class="btn btn-primary btn-sm">
                                        Download
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No orders found.</td>
                        </tr>
                    @endforelse --}}

        </div>
        @if($orders->hasPages())
            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        @endif
        </section>
@endsection 