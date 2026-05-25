@extends('layouts.app')

@section('title', 'My Account')

@section('content')
<div style="max-width:520px;margin:0 auto;">
    <div class="card">
        <div style="padding:32px 24px;display:flex;flex-direction:column;align-items:center;gap:12px;border-bottom:0.5px solid var(--border);">
            <div style="width:64px;height:64px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;font-size:26px;font-weight:700;color:#fff;">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div style="text-align:center;">
                <div style="font-size:17px;font-weight:600;">{{ $user->name }}</div>
                <div style="font-size:13px;color:var(--muted);margin-top:2px;">{{ $user->email }}</div>
            </div>
            @if($user->role === 'admin')
                <span class="badge blue" style="font-size:12px;padding:5px 14px;">
                    <i class="ti ti-shield" style="font-size:13px;margin-right:4px;"></i> Administrator
                </span>
            @else
                <span class="badge green" style="font-size:12px;padding:5px 14px;">
                    <i class="ti ti-user" style="font-size:13px;margin-right:4px;"></i> Staff
                </span>
            @endif
        </div>

        <div style="padding:24px;">
            <div style="font-size:12px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:0.05em;margin-bottom:14px;">Account Details</div>

            <div style="display:flex;flex-direction:column;gap:12px;">
                <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 0;border-bottom:0.5px solid var(--border);">
                    <span style="font-size:13px;color:var(--muted);">Full Name</span>
                    <span style="font-size:13px;font-weight:500;">{{ $user->name }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 0;border-bottom:0.5px solid var(--border);">
                    <span style="font-size:13px;color:var(--muted);">Email</span>
                    <span style="font-size:13px;font-weight:500;">{{ $user->email }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 0;border-bottom:0.5px solid var(--border);">
                    <span style="font-size:13px;color:var(--muted);">Role</span>
                    <span style="font-size:13px;font-weight:500;">{{ ucfirst($user->role) }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 0;border-bottom:0.5px solid var(--border);">
                    <span style="font-size:13px;color:var(--muted);">Status</span>
                    @if($user->is_active)
                        <span class="badge green">Active</span>
                    @else
                        <span class="badge red">Inactive</span>
                    @endif
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 0;">
                    <span style="font-size:13px;color:var(--muted);">Member Since</span>
                    <span style="font-size:13px;font-weight:500;">{{ $user->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection