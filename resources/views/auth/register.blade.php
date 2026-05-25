{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.auth')
@section('title', 'Register')

@section('content')
<div class="auth-card">
    <div class="brand">
        <div class="brand-icon">🚗</div>
        <h1>Create Account</h1>
        <p>Vehicle Maintenance System</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Full Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                placeholder="Juan Dela Cruz"
            />
            @error('name')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                placeholder="you@example.com"
            />
            @error('email')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="" disabled selected>Select role…</option>
                <option value="admin"  {{ old('role') === 'admin'  ? 'selected' : '' }}>Admin</option>
                <option value="staff"  {{ old('role') === 'staff'  ? 'selected' : '' }}>Staff</option>
            </select>
            @error('role')
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
                placeholder="Min. 8 characters"
            />
            @error('password')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                required
                placeholder="Repeat password"
            />
        </div>

        <button type="submit" class="btn-primary">Create Account →</button>
    </form>

    <div class="auth-footer">
        Already have an account?
        <a href="{{ route('login') }}">Sign in here</a>
    </div>
</div>
@endsection