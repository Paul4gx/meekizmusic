@extends('layouts.app')

@section('title', 'Marketplace')

@section('content')
<div class="page-content bg-white">
<!-- Banner Starts -->
<x-breadcrumb title="Marketplace" content="Browse our collection of high-quality beats" />
<!-- Banner End -->
		<!-- Search Section -->
		<section class="content-inner-1">
			<div class="container">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-xl-3 col-lg-3 order-lg-1 order-2 m-b30">
        	<aside class="side-bar left sticky-top">
                <div class="widget">
                    <div class="widget-title">
                        <h4 class="title">Search</h4>
                    </div>
                    <div class="search-bx">
                        <form action="{{ route('marketplace.index') }}" method="GET">
                            <div class="input-side">
                                <input type="text" class="form-control" name="search" placeholder="Search beats..." value="{{ request('search') }}">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewbox="0 0 20 20" fill="none">
                                          <g clip-path="url(#clip0_1338_6867)">
                                            <path d="M19.6678 17.732L14.0056 12.3034C15.1024 11.0045 15.7628 9.354 15.7628 7.55639C15.7628 3.39004 12.2269 0 7.88136 0C3.53581 0 0 3.39001 0 7.55636C0 11.7227 3.53585 15.1128 7.8814 15.1128C9.75632 15.1128 11.4778 14.4796 12.8326 13.4281L18.4947 18.8567C18.6565 19.0118 18.8689 19.0898 19.0813 19.0898C19.2937 19.0898 19.506 19.0118 19.6678 18.8567C19.9922 18.5457 19.9922 18.043 19.6678 17.732ZM7.8814 13.5219C4.45008 13.5219 1.65925 10.8462 1.65925 7.55636C1.65925 4.26653 4.45008 1.59079 7.8814 1.59079C11.3127 1.59079 14.1035 4.26653 14.1035 7.55636C14.1035 10.8462 11.3127 13.5219 7.8814 13.5219Z" fill="#222222"></path>
                                          </g>
                                          <defs>
                                            <clippath id="clip0_1338_6867">
                                              <rect width="19.9111" height="19.09" fill="white"></rect>
                                            </clippath>
                                          </defs>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="widget widget_categories">
                    <div class="widget-title">
                        <h4 class="title">Genres</h4>
                    </div>
                    <ul>
                        @foreach($genres as $genre)
                            <li class="cat-item"><a href="javascript:void(0);">{{ $genre->name }}</a>(1)</li>
                        @endforeach
                    </ul>
                </div>
                {{-- <div class="widget">
                    <h6 class="widget-title"></h6>
                    <div class="price-slide range-slider">
                        <div class="price">
                            <div class="range-slider style-1">
                                <div id="slider-tooltips" class="mb-3"></div>
                                <span class="example-val" id="slider-margin-value-min"></span>
                                <span class="example-val" id="slider-margin-value-max"></span>
                            </div>
                        </div>
                    </div>
                </div> --}}
                    <!-- Price Range -->
                    <div class="widget">
                        <h6 class="widget-title">Price Range</h6>
                        <div class="price-range">
                            <input type="number" class="form-control mb-2" name="min_price" placeholder="Min Price" value="{{ request('min_price') }}">
                            <input type="number" class="form-control" name="max_price" placeholder="Max Price" value="{{ request('max_price') }}">
                        </div>
                    </div>

                    <!-- BPM Range -->
                    <div class="widget">
                        <h6 class="widget-title">BPM Range</h6>
                        <div class="bpm-range">
                            <input type="number" class="form-control mb-2" name="min_bpm" placeholder="Min BPM" value="{{ request('min_bpm') }}">
                            <input type="number" class="form-control" name="max_bpm" placeholder="Max BPM" value="{{ request('max_bpm') }}">
                        </div>
                    </div>

                    <!-- Apply Filters Button -->
                    <button class="btn btn-primary w-100" onclick="applyFilters()">Apply Filters</button>
            </aside>
                </div>


        <!-- Main Content -->
        <div class="col-xl-9 col-lg-9 order-lg-2 order-1 m-b30">
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

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @forelse($beats as $beat)
                <x-beatcolumn :beat="$beat" />
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        No beats found. Please try different filters.
                    </div>
                </div>
            @endforelse
                
                    {{-- <div class="col">
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
                                            <li><a href="#">{{ $genre->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> --}}
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center mt-4">
                        {{ $beats->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
        </section>
</div>

@push('scripts')
<script>
function applyFilters() {
    let url = new URL(window.location.href);
    let params = new URLSearchParams(url.search);
    
    // Get selected genres
    let genres = [];
    document.querySelectorAll('input[name="genres[]"]:checked').forEach(checkbox => {
        genres.push(checkbox.value);
    });
    params.set('genres', genres.join(','));
    
    // Get price range
    params.set('min_price', document.querySelector('input[name="min_price"]').value);
    params.set('max_price', document.querySelector('input[name="max_price"]').value);
    
    // Get BPM range
    params.set('min_bpm', document.querySelector('input[name="min_bpm"]').value);
    params.set('max_bpm', document.querySelector('input[name="max_bpm"]').value);
    
    // Redirect with filters
    window.location.href = `${url.pathname}?${params.toString()}`;
}
</script>
@endpush
@endsection 