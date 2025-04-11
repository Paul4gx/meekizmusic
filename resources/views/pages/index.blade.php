@extends('layouts.app')

@section('title', 'Welcome')

@section('metadata')
@endsection

@section('headerscript')
@endsection

@section('content')
<div class="page-content bg-white">
    <!-- Banner -->
    <div class="main-bnr-three overflow-hidden">
        <div class="main-slider-2">
            <div class="banner-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-12">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="banner-content">
                                        <h1 class="title wow fadeInUp" data-wow-delay="0.2s">A Celebration of Artistry and Inspiration</h1>
                                        <p class="wow fadeInUp" data-wow-delay="0.4s">Velit egestas dui id ornare arcu. Nibh sit amet commodo nulla nullam vehicula. Arcu dictum varius duis at consectetur.......</p>
                                        <div class="banner-btn wow fadeInUp" data-wow-delay="0.6s">
                                            <a href="{{ route('contact') }}" class="btn btn-dark btn-hover-5 btn-md m-b20 m-sm-b0"><span class="btn-text">DISCOVER MORE</span></a>
                                            <div class="customer-box">
                                                <ul>
                                                    <li class="customer-image">
                                                        <img src="{{ asset('assets/images/main-slider/slider2/pic1.png') }}" alt="">
                                                    </li>
                                                    <li class="customer-image">
                                                        <img src="{{ asset('assets/images/main-slider/slider2/pic2.png') }}" alt="">
                                                    </li>
                                                    <li class="customer-image">
                                                        <img src="{{ asset('assets/images/main-slider/slider2/pic3.png') }}" alt="">
                                                    </li>
                                                </ul>
                                                <div class="dz-content">
                                                    <h6 class="title text-dark">Happy Customer</h6>
                                                    <span class="review"><i class="fa-solid fa-star"></i> 4.8(12k Review)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="banner-content bottom-content">
                                        <h4 class="sub-title wow fadeInUp" data-wow-delay="0.2s">Let's Create best Music With Our Experience</h4>
                                        <div class="d-flex align-items-center wow fadeInUp" data-wow-delay="0.8s">
                                            <div class="counter-box style-1 m-r30">
                                                <h2 class="title"><span class="counter">200</span>+</h2>
                                                <p class="text">Project Completed</p>
                                            </div>
                                            <div class="counter-box style-1">
                                                <h2 class="title"><span class="counter">100</span>+</h2>
                                                <p class="text">Live Concerts</p>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-5 col-md-12">
                            <div class="banner-media">
                                <img src="{{ asset('assets/images/main-slider/slider3/pic1.jpg') }}" class="item-bg" alt="/">                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 