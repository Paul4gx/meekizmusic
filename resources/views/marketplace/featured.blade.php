@extends('layouts.app')

@section('title', 'Featured Beats')

@section('content')
<div class="page-content bg-white">
    <!-- Banner Starts -->
<x-breadcrumb title="Featured Beats" content="Discover our collection of Freshly Selected beats" />
<!-- Banner End -->
<section class="content-inner-1">
    <div class="container">
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
                            <option value="{{ route('marketplace.afrobeat', ['sort' => 'newest']) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="{{ route('marketplace.afrobeat', ['sort' => 'price_low_high']) }}" {{ request('sort') == 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="{{ route('marketplace.afrobeat', ['sort' => 'price_high_low']) }}" {{ request('sort') == 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="{{ route('marketplace.afrobeat', ['sort' => 'most_popular']) }}" {{ request('sort') == 'most_popular' ? 'selected' : '' }}>Most Popular</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($beats as $beat)
        <x-beatcolumn :beat="$beat" colClass="col-6 col-lg-3 col-md-3" />
        @empty
        <div class="col-12">
            <div class="alert alert-info">
                No Featured beats found. Please check back later.
            </div>
        </div>
    @endforelse
    
    </div>

    {{ $beats->links('vendor.pagination.custom') }}

</div>
</section>
</div>
@endsection 