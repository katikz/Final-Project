@extends('layouts.app')

@section('title', 'Add Vehicle')

@section('topbar-actions')
    <a href="{{ route('vehicles.index') }}" class="btn btn-ghost">
        <i class="ti ti-arrow-left" style="font-size:14px"></i> Back to Vehicles
    </a>
@endsection

@section('content')
<div style="max-width:620px;margin:0 auto;">
    <div class="card">
        <div class="card-header" style="padding:20px 24px 0;">
            <div style="display:flex;align-items:center;gap:12px;padding-bottom:16px;border-bottom:0.5px solid var(--border);">
                <div class="stat-icon blue" style="width:38px;height:38px;font-size:18px;">
                    <i class="ti ti-car"></i>
                </div>
                <div>
                    <div style="font-size:15px;font-weight:600;">Add New Vehicle</div>
                    <div style="font-size:12px;color:var(--muted);margin-top:2px;">Fill in the vehicle details below</div>
                </div>
            </div>
        </div>

        <div style="padding:24px;">
            <form action="{{ route('vehicles.store') }}" method="POST">
                @csrf

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

                    {{-- Plate Number --}}
                    <div style="grid-column:span 2;">
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--muted);margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Plate Number</label>
                        <input type="text" name="plate_number" value="{{ old('plate_number') }}" required maxlength="20"
                            placeholder="e.g. ABC-1234"
                            style="width:100%;padding:10px 14px;border:1.5px solid {{ $errors->has('plate_number') ? '#dc2626' : 'var(--border)' }};border-radius:8px;font-size:13px;font-family:var(--mono);outline:none;background:var(--surface);">
                        @error('plate_number')
                            <div style="color:#dc2626;font-size:11px;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Owner Name --}}
                    <div style="grid-column:span 2;">
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--muted);margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Owner Name</label>
                        <input type="text" name="owner_name" value="{{ old('owner_name') }}" maxlength="100"
                            placeholder="e.g. Cakezz"
                            style="width:100%;padding:10px 14px;border:1.5px solid {{ $errors->has('owner_name') ? '#dc2626' : 'var(--border)' }};border-radius:8px;font-size:13px;outline:none;background:var(--surface);">
                        @error('owner_name')
                            <div style="color:#dc2626;font-size:11px;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Make --}}
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--muted);margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Make</label>
                        <input type="text" name="make" value="{{ old('make') }}" required maxlength="50"
                            placeholder="e.g. Toyota"
                            style="width:100%;padding:10px 14px;border:1.5px solid {{ $errors->has('make') ? '#dc2626' : 'var(--border)' }};border-radius:8px;font-size:13px;outline:none;background:var(--surface);">
                        @error('make')
                            <div style="color:#dc2626;font-size:11px;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Model --}}
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--muted);margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Model</label>
                        <input type="text" name="model" value="{{ old('model') }}" required maxlength="50"
                            placeholder="e.g. Hilux"
                            style="width:100%;padding:10px 14px;border:1.5px solid {{ $errors->has('model') ? '#dc2626' : 'var(--border)' }};border-radius:8px;font-size:13px;outline:none;background:var(--surface);">
                        @error('model')
                            <div style="color:#dc2626;font-size:11px;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Year --}}
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--muted);margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Year</label>
                        <input type="number" name="year" value="{{ old('year') }}" required min="1900" max="{{ date('Y') + 1 }}"
                            placeholder="{{ date('Y') }}"
                            style="width:100%;padding:10px 14px;border:1.5px solid {{ $errors->has('year') ? '#dc2626' : 'var(--border)' }};border-radius:8px;font-size:13px;font-family:var(--mono);outline:none;background:var(--surface);">
                        @error('year')
                            <div style="color:#dc2626;font-size:11px;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Mileage --}}
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--muted);margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Mileage (km)</label>
                        <input type="number" name="mileage" value="{{ old('mileage') }}" required min="0"
                            placeholder="0"
                            style="width:100%;padding:10px 14px;border:1.5px solid {{ $errors->has('mileage') ? '#dc2626' : 'var(--border)' }};border-radius:8px;font-size:13px;font-family:var(--mono);outline:none;background:var(--surface);">
                        @error('mileage')
                            <div style="color:#dc2626;font-size:11px;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div style="grid-column:span 2;">
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--muted);margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Status</label>
                        <select name="status" required
                            style="width:100%;padding:10px 14px;border:1.5px solid {{ $errors->has('status') ? '#dc2626' : 'var(--border)' }};border-radius:8px;font-size:13px;outline:none;background:var(--surface);color:var(--text);">
                            <option value="">Select status</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div style="color:#dc2626;font-size:11px;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- Actions --}}
                <div style="display:flex;gap:10px;margin-top:24px;padding-top:20px;border-top:0.5px solid var(--border);">
                    <button type="submit" class="btn btn-primary" style="flex:1;;justify-content:center;"                 
>
                        <i class="ti ti-device-floppy" style="font-size:14px"></i> Save Vehicle 
                    </button>
                    <a href="{{ route('vehicles.index') }}" class="btn btn-ghost" style="flex:1;justify-content:center;">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection