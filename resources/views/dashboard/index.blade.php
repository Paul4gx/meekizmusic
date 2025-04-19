@php($title = 'Dashboard')
@extends('layouts.auth')

@section('title', 'Dashboard')

@section('content')

<section class="content-inner-2 pt-0">
    <div class="container">
        <div class="row justify-content-between align-items-end">
            <div class="text-center text-xl-start col-xl-6">
                <div class="section-head">
                    <h4 class="title wow flipInX" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: flipInX;">Welcome back, {{ Auth::user()->name }}!</h4>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="dz-card style-2 blog-half overlay-shine dz-img-effect zoom m-b30 wow flipInX" data-wow-delay="1.6s" style="visibility: visible; animation-delay: 1.6s; animation-name: flipInX;">
                    <span style="background-color:white;border-radius:50%;display:flex;justify-content:center;align-items:center;position:absolute;bottom:10px;right:15px;z-index:100;width:40px;height:40px;">
                        <i class="fa-solid fa-cart-shopping" style="
                            font-size:20px;
                            background: linear-gradient(90deg, #FF421D -2.36%, #D01266 101.57%);
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                            padding:10px;">
                        </i>
                    </span>
                                        <div class="dz-info bg-gray">
                        <h6 class="dz-subtitle"><a>Total Purchases</a></h6>
                        <h5 class="dz-title"><a>{{ $stats['total_purchases'] }}</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="dz-card style-2 blog-half overlay-shine dz-img-effect zoom m-b30 wow flipInX" data-wow-delay="1.6s" style="visibility: visible; animation-delay: 1.6s; animation-name: flipInX;">
                    <span style="background-color:white;border-radius:50%;display:flex;justify-content:center;align-items:center;position:absolute;bottom:10px;right:15px;z-index:100;width:40px;height:40px;">
                        <i class="fa-solid fa-dollar-sign" style="
                            font-size:20px;
                            background: linear-gradient(90deg, #FF421D -2.36%, #D01266 101.57%);
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                            padding:10px;">
                        </i>
                    </span>
                                        <div class="dz-info bg-gray">
                        <h6 class="dz-subtitle"><a>Total Spent</a></h6>
                        <h5 class="dz-title"><a>{{ currency_symbol().number_format($stats['total_spent'], 2) }}</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="dz-card style-2 blog-half overlay-shine dz-img-effect zoom m-b30 wow flipInX" data-wow-delay="1.6s" style="visibility: visible; animation-delay: 1.6s; animation-name: flipInX;">
                    <span style="background-color:white;border-radius:50%;display:flex;justify-content:center;align-items:center;position:absolute;bottom:10px;right:15px;z-index:100;width:40px;height:40px;">
                        <i class="fa-solid fa-heart" style="
                            font-size:20px;
                            background: linear-gradient(90deg, #FF421D -2.36%, #D01266 101.57%);
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                            padding:10px;">
                        </i>
                    </span>
                                        <div class="dz-info bg-gray">
                        <h6 class="dz-subtitle"><a>Wishlist Items</a></h6>
                        <h5 class="dz-title"><a>{{ $stats['wishlist_count'] }}</a></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col-md-12">
                <h4 class="title wow flipInX" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: flipInX;">Recently Played</h4>
            </div>
            @forelse($recentlyPlayed as $beat)
            <x-beatcolumn :beat="$beat" colClass="col-6 col-lg-3 col-md-3"/>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No recently played beats.
                </div>
            </div>
        @endforelse
            
        </div>
    </div>
</section>
<section class="content-inner-1">
    <div class="container">
        <div class="row justify-content-between align-items-end">
            <div class="text-center text-xl-start col-xl-6">
                <div class="section-head ">
                    <h3 class="title wow flipInX" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: flipInX;">Recent Purchases</h3>
                </div>
            </div>
            <div class="text-center text-xl-end col-xl-6 m-b30 m-lg-b40">
                <a href="{{route('purchased.index')}}" class="btn-link btn-gradient wow flipInX" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: flipInX;">View All</a>
            </div>
            <div id="download-alert" class="alert alert-success d-none">
                Your download in progress...
            </div>
        </div>

        <div class="row dz-tooltip-blog wow fadeInUp" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
            @forelse($recentPurchases as $order)
            <div class="col-12">
                <div class="dz-card style-4">
                    <div class="row dz-info justify-content-between">
                        <div class="col-lg-2">
                            <span class="small-title">Date:</span>
                            <h5 class="dz-title"><a>{{ $order->created_at->format('M d, Y') }}</a></h5>
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
    </div>
</section>

@push('scripts')
<script>
    function startDownload(url) {
        // Show message
        document.getElementById('download-alert').classList.remove('d-none');
    }
</script>
@endpush
@endsection 