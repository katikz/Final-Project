@extends('layouts.app')

@section('title', 'Schedule Maintenance')

@section('topbar-actions')
    <a href="{{ route('maintenance.index') }}" class="btn btn-ghost">
        <i class="ti ti-arrow-left" style="font-size:14px"></i> Back to Maintenance
    </a>
@endsection

@section('content')
<div style="max-width:620px;margin:0 auto;">
    <div class="card">
        <div class="card-header" style="padding:20px 24px 0;">
            <div style="display:flex;align-items:center;gap:12px;padding-bottom:16px;border-bottom:0.5px solid var(--border);">
                <div class="stat-icon amber" style="width:38px;height:38px;font-size:18px;">
                    <i class="ti ti-tools"></i>
                </div>
                <div>
                    <div style="font-size:15px;font-weight:600;">Schedule New Maintenance</div>
                    <div style="font-size:12px;color:var(--muted);margin-top:2px;">Fill in the maintenance details below</div>
                </div>
            </div>
        </div>

        <div style="padding:24px;">
            <form action="{{ route('maintenance.store') }}" method="POST">
                @csrf

                <div style="display:flex;flex-direction:column;gap:16px;">

                    {{-- Vehicle --}}
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--muted);margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Vehicle</label>
                        <select name="vehicle_id" required
                            style="width:100%;padding:10px 14px;border:1.5px solid {{ $errors->has('vehicle_id') ? '#dc2626' : 'var(--border)' }};border-radius:8px;font-size:13px;outline:none;background:var(--surface);color:var(--text);">
                            <option value="">Select a vehicle</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->plate_number }} — {{ $vehicle->make }} {{ $vehicle->model }}
                                </option>
                            @endforeach
                        </select>
                        @error('vehicle_id')
                            <div style="color:#dc2626;font-size:11px;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Maintenance Type --}}
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--muted);margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Maintenance Type</label>
                        <input type="text" name="type" value="{{ old('type') }}" required maxlength="100"
                            placeholder="e.g. Oil Change, Tire Rotation"
                            style="width:100%;padding:10px 14px;border:1.5px solid {{ $errors->has('type') ? '#dc2626' : 'var(--border)' }};border-radius:8px;font-size:13px;outline:none;background:var(--surface);">
                        @error('type')
                            <div style="color:#dc2626;font-size:11px;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Scheduled Date --}}
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--muted);margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Scheduled Date</label>
                        <input type="date" name="scheduled_date" value="{{ old('scheduled_date') }}" required min="{{ now()->toDateString() }}"
                            style="width:100%;padding:10px 14px;border:1.5px solid {{ $errors->has('scheduled_date') ? '#dc2626' : 'var(--border)' }};border-radius:8px;font-size:13px;outline:none;background:var(--surface);">
                        @error('scheduled_date')
                            <div style="color:#dc2626;font-size:11px;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--muted);margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Status</label>
                        <select name="status" required
                            style="width:100%;padding:10px 14px;border:1.5px solid {{ $errors->has('status') ? '#dc2626' : 'var(--border)' }};border-radius:8px;font-size:13px;outline:none;background:var(--surface);color:var(--text);">
                            <option value="">Select status</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="overdue" {{ old('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                        </select>
                        @error('status')
                            <div style="color:#dc2626;font-size:11px;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Notes --}}
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--muted);margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Notes</label>
                        <textarea name="notes" rows="3"
                            placeholder="Optional notes about this maintenance..."
                            style="width:100%;padding:10px 14px;border:1.5px solid {{ $errors->has('notes') ? '#dc2626' : 'var(--border)' }};border-radius:8px;font-size:13px;outline:none;background:var(--surface);resize:vertical;font-family:var(--font);">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div style="color:#dc2626;font-size:11px;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- Actions --}}
                <div style="display:flex;gap:10px;margin-top:24px;padding-top:20px;border-top:0.5px solid var(--border);">
                <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center;">
                    <i class="ti ti-calendar-plus" style="font-size:14px"></i> Schedule Maintenance
                    </button>
                    <a href="{{ route('maintenance.index') }}" class="btn btn-ghost" style="flex:1;justify-content:center;">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection