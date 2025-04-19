@php($title = 'My Wishlist')
@extends('layouts.auth')

@section('title', 'My Wishlist')

@section('content')
<section class="content-inner-2 pt-0">
    <div class="container">
        <div class="row">

            @forelse($wishlistItems as $beat)
                <x-beatcolumn :beat="$beat" colClass="col-6 col-lg-3 col-md-3"/>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        No items in your wishlist.
                    </div>
                </div>
            @endforelse
        </div>

        @if($wishlistItems->hasPages())
            <div class="mt-4">
                {{ $wishlistItems->links() }}
            </div>
        @endif
    </div>
</section>

@push('scripts')
@endpush
@endsection 