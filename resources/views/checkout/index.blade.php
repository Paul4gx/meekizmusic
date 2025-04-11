@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Checkout</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Order Summary -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold mb-4">Order Summary</h2>
                
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="relative w-20 h-20 rounded-lg overflow-hidden" style="background-color: {{ $beat->color_accent }}">
                            <img src="{{ Storage::url($beat->cover_image) }}" alt="{{ $beat->title }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="font-semibold">{{ $beat->title }}</h3>
                            <p class="text-gray-600">${{ number_format($beat->price, 2) }}</p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 my-4"></div>

                <div class="flex justify-between items-center">
                    <span class="font-semibold">Total</span>
                    <span class="text-xl font-bold">${{ number_format($beat->price, 2) }}</span>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold mb-4">Payment Details</h2>
                
                <form action="{{ route('checkout.initialize') }}" method="POST">
                    @csrf
                    <input type="hidden" name="beat_id" value="{{ $beat->id }}">

                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-600 mb-4">
                                You will be redirected to Paystack to complete your payment securely.
                            </p>
                        </div>

                        <button type="submit" class="w-full bg-primary text-white py-3 px-6 rounded-lg font-semibold hover:bg-primary-dark transition duration-300">
                            Pay ${{ number_format($beat->price, 2) }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 