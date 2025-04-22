@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="page-content bg-white">
<section class="login-wrapper overlay-black-middle" style="background-image: url(assets/images/background/pic5.jpg);">     
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <h1 class="text-center mb-4">Login</h1>

                    @if (session('status'))
                        <div class="alert alert-success mb-3">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                        </div>

                        <div class="text-center mt-3">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none">
                                    Forgot your password?
                                </a>
                            @endif
                        </div>

                        <div class="text-center mt-4">
                            <p class="mb-0">Don't have an account?</p>
                            <a href="{{ route('register') }}" class="btn btn-link text-decoration-none">
                                Create an Account
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
</div>
@endsection 