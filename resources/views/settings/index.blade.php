@extends('layouts.auth')
@section('title', 'Settings')
@section('content')
<section class="content-inner-2 pt-0">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Change Password Form -->
                    <h5 class="mb-4">Change Password</h5>
                    <form action="{{ route('settings.password') }}" method="POST" class="mb-5">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>

                    <hr>

                    <!-- Delete Account Form -->
                    <h5 class="mt-4">Delete Account</h5>
                    <p class="text-muted">Once you delete your account, there is no going back. Please be certain.</p>
                    <form action="{{ route('settings.account') }}" method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirmation" class="form-label">Type DELETE to confirm</label>
                            <input type="text" class="form-control @error('confirmation') is-invalid @enderror" id="confirmation" name="confirmation" required>
                            @error('confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-danger">Delete Account</button>
                    </form>
                </div>
            </div>
        </div>
@endsection 