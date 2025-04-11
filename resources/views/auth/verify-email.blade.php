@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <h1 class="text-center mb-4">Verify Your Email Address</h1>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success mb-4">
                            A new verification link has been sent to your email address.
                        </div>
                    @endif

                    <p class="text-center mb-4">
                        Thanks for signing up! Before getting started, could you verify your email address by clicking on the
                        link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                    </p>

                    <div class="d-flex justify-content-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                Resend Verification Email
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 