@extends('layouts.app')

@section('title', 'Browse Beats by Genre')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="dz-banner-inner style-1 text-center">
                <h2 class="dz-title">Browse Beats by Genre</h2>
                <p class="text">Discover our collection of high-quality beats across various genres</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="filter-wrapper">
                <div class="filter-left-area">
                    <span>Showing {{ $beats->firstItem() ?? 0 }}-{{ $beats->lastItem() ?? 0 }} of {{ $beats->total() }} results</span>
                </div>
                <div class="filter-right-area">
                    <span class="m-r15">Sort by</span>
                    <div class="form-group">
                        <select class="default-select" onchange="window.location.href=this.value">
                            <option value="{{ route('marketplace.index', ['sort' => 'newest']) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="{{ route('marketplace.index', ['sort' => 'price_low_high']) }}" {{ request('sort') == 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="{{ route('marketplace.index', ['sort' => 'price_high_low']) }}" {{ request('sort') == 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="{{ route('marketplace.index', ['sort' => 'most_popular']) }}" {{ request('sort') == 'most_popular' ? 'selected' : '' }}>Most Popular</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($beats as $beat)
            <div class="col">
                <div class="dz-card style-1">
                    <div class="dz-media">
                        <img src="{{ $beat->image_url ?? asset('assets/images/shop/product/pic1.png') }}" alt="{{ $beat->title }}">
                        <div class="dz-meta">
                            <ul>
                                <li class="dz-cart">
                                    <a href="#" class="btn btn-primary btn-hover-2">Preview</a>
                                </li>
                                <li class="dz-wishlist">
                                    <a href="#" class="btn btn-icon btn-light btn-hover-2"><i class="fa-solid fa-heart"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="dz-content">
                        <h5 class="dz-title"><a href="#">{{ $beat->title }}</a></h5>
                        <div class="dz-meta">
                            <ul>
                                <li class="dz-price">${{ number_format($beat->price, 2) }}</li>
                                <li class="dz-bpm">{{ $beat->bpm }} BPM</li>
                            </ul>
                        </div>
                        <div class="dz-category">
                            <ul>
                                @foreach($beat->genres as $genre)
                                    <li><a href="{{ route('marketplace.index', ['genre' => $genre->id]) }}">{{ $genre->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No beats found. Please try different filters.
                </div>
            </div>
        @endforelse
    </div>

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center mt-4">
                {{ $beats->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 