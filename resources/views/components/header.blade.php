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
    <title>@yield('title', config('app.name', 'Meekizmusic'))</title>
    
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    
    <!-- Stylesheet -->
    <link href="{{asset('/assets/vendor/animate/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/vendor/magnific-popup/magnific-popup.min.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/vendor/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/vendor/tempus-dominus/css/tempus-dominus.min.css')}}" rel="stylesheet">
    
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @stack('styles')
    @yield('headerscript')
    <style>
        /* Style the dropdown button */
#userDropdown {
    padding-left: 10px; /* Space on the left */
    padding-right: 10px; /* Space on the right */
    font-size: 16px;
    display: flex;
    align-items: center;
}

/* Style the user icon */
#userDropdown i {
    font-size: 20px; /* Set the size of the icon */
    color: #fff; /* Make the icon white */
}

/* Style the dropdown items */
.dropdown-menu {
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    min-width: 180px; /* Prevent items from being scattered */
}

/* Style each dropdown item */
.dropdown-item {
    padding: 10px 20px;
    font-size: 14px;
    color: #333;
    transition: background-color 0.3s ease;
}

/* Hover effect for items */
.dropdown-item:hover {
    background-color: #f1f1f1;
    color: #000;
}

/* Style the logout button */
.dropdown-item[type="submit"] {
    background-color: #dc3545;
    color: #fff;
}

/* Hover effect for logout button */
.dropdown-item[type="submit"]:hover {
    background-color: #c82333;
    color: #fff;
}

/* Add spacing between the logout item and the other items */
.dropdown-divider {
    margin: 8px 0;
}
.site-header .extra-nav ul li{
    display: block !important;
}
</style>
</head>
<body id="bg">
    {{-- <div id="loading-area-4" class="loading-page-4">
        <div class="loading-inner">
            <div class="loader"></div>
            <div class="loder-section left-section"></div>
            <div class="loder-section right-section"></div>
        </div>
    </div> --}}

    <div class="page-wrapper">
        @include('components.navbar') 