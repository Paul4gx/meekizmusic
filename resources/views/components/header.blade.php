<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="DexignZone">
    <meta name="keywords" content="@yield('meta_keywords', 'beats, music production, hip hop beats, trap beats, r&b beats')">
    <meta name="robots" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Your premier destination for high-quality beats and music production.')">
    @yield('metadata')
    <title>@yield('title', config('app.name', 'Meekismusic'))</title>
    
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    
    <!-- Stylesheet -->
    <link href="{{asset('/assets/vendor/animate/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/vendor/magnific-popup/magnific-popup.min.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/vendor/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/vendor/tempus-dominus/css/tempus-dominus.min.css')}}" rel="stylesheet">
    
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{asset('/assets/vendor/rangeslider/rangeslider.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/vendor/switcher/switcher.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
    <link href="{{asset('/assets/vendor/perfect-scrollbar/css/perfect-scrollbar.min.css')}}" rel="stylesheet">        

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @yield('headerscript')
</head>
<body id="bg">
    <div id="loading-area-4" class="loading-page-4">
        <div class="loading-inner">
            <div class="loader"></div>
            <div class="loder-section left-section"></div>
            <div class="loder-section right-section"></div>
        </div>
    </div>

    <div class="page-wrapper">
        @include('components.navbar') 