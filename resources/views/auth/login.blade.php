@extends('layouts.auth')
@section('title', 'Login')

@section('content')
<div class="auth-card">
    <div class="brand">
        <div class="brand-icon">🚗</div>
        <h1>Welcome Back</h1>
        <p>Vehicle Maintenance System</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                placeholder="you@example.com"
            />
            @error('email')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                required
                placeholder="Your password"
            />
            @error('password')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>

        <div class="checkbox-row">
            <input type="checkbox" id="remember" name="remember" />
            <label for="remember">Remember me</label>
        </div>

        <button type="submit" class="btn-primary">Sign In →</button>
    </form>

    <div class="auth-footer">
        Don't have an account?
        <a href="{{ route('register') }}">Create one here</a>
    </div>
</div>
@endsection