@php($title = 'Purchases')
@extends('layouts.auth')
@section('title', 'My Orders')
@section('content')
<section class="content-inner-2 pt-0">
    <div class="container">
        <div class="row dz-tooltip-blog wow fadeInUp" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div id="download-alert" class="alert alert-success d-none">
        Your download in progress...
    </div>
            @forelse($orders as $order)
            <div class="col-12">
                <div class="dz-card style-4">
                    <div class="row dz-info justify-content-between">
                        <div class="col-lg-2">
                            <span class="small-title">Date:</span>
                            <h5 class="dz-title m-0"><a>{{ $order->created_at->format('M d, Y') }}</a></h5>
                            <a class="btn btn-link p-0 m-0 mb-2 d-flex justify-content-center" style="float: left;font-size:0.7rem;color:blue;" href="{{ route('license.download', $order->beat) }}"> <i class="la la-file" style="margin-left:0;font-size:0.8rem;"></i> Download License</a>
                        </div>
                        <div class="col-lg-3">
                            <span class="small-title">Beat title:</span>
                            <h5 class="dz-title"><a href="{{ route('beats.show', $order->beat) }}">{{ $order->beat->title }}</a></h5>
                        </div>
                        <div class="col-lg-2">
                            <span class="small-title">Amount:</span>
                            <h5 class="dz-title"><a>{{ currency_symbol().number_format($order->amount, 2) }}</a></h5>
                        </div>
                        <div class="col-lg-2">
                            <span class="small-title">Payment status:</span>
                            
                            <!-- Set the text color based on the payment status -->
                            <h5 class="dz-title">
                                <!-- Conditionally set class and text based on payment status -->
                                <span class="{{ $order->status === 'completed' ? 'text-success' : ($order->status === 'failed' ? 'text-danger' : 'text-warning') }}">
                                    {{ ucfirst($order->status) }} <!-- Capitalize the first letter of status -->
                                </span>
                            </h5>
                            
                            <!-- Show a retry payment form for failed payment -->
                            @if($order->status === 'failed')
                                <form action="{{ route('checkout.initialize') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="beat_id" value="{{ $beat->id }}"> <!-- Beat ID for retrying payment -->
                                    <button type="submit" class="btn btn-danger btn-md rounded-0 text-uppercase">
                                        Retry Payment
                                    </button>
                                </form>
                            @elseif($order->status === 'unknown')
                                <a class="btn btn-warning" href="/contact">Contact Customer Care</a>
                            @endif
                        </div>
                        
                        
                        <div class="col-lg-1">
                            <a href="{{ route('purchased.download', $order) }}" onclick="startDownload()" class="btn-link text-secondary"><i class="la la-arrow-down"></i>
                            <span class="d-block" style="font-size:0.7rem">Download full Beat</span></a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
                <div class="text-center">No recent purchases.</div>
        @endforelse 
        </div>
        <script>
            function startDownload(url) {
                // Show message
                document.getElementById('download-alert').classList.remove('d-none');
            }
        </script>
        </div>
        {{ $orders->links('vendor.pagination.custom') }}

        </section>
@endsection 