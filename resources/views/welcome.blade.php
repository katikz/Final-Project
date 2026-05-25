@extends('layouts.auth')

@section('title', 'Welcome')

@section('content')
<div class="auth-card">
    <div class="brand">
        <div class="brand-icon">🚗</div>
        <h1>Vehicle Maintenance System</h1>
        <p>Sign in to access your fleet dashboard</p>
    </div>

    <div style="display:flex;gap:12px;margin-top:20px">
        <a href="{{ route('login') }}" class="btn-primary" style="flex:1;text-align:center;text-decoration:none;display:inline-block">Sign In</a>
        <a href="{{ route('register') }}" class="btn-primary" style="flex:1;background:#6b7280;text-align:center;text-decoration:none;display:inline-block">Register</a>
    </div>
</div>
@endsection