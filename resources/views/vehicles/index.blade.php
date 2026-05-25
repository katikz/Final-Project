@extends('layouts.app')

@section('title', 'Vehicles')

@section('topbar-actions')
    <a href="{{ route('vehicles.create') }}" class="btn btn-primary">
        <i class="ti ti-plus" style="font-size:14px"></i> Add Vehicle
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">All Vehicles</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Vehicle</th>
                    <th>Plate</th>
                    <th>Mileage</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vehicles as $vehicle)
                <tr>
                    <td>
                        <div class="vehicle-name">{{ $vehicle->make }} {{ $vehicle->model }}</div>
                        <div class="plate">{{ $vehicle->year }}</div>
                    </td>
                    <td style="font-family:var(--mono);font-size:12px">{{ $vehicle->plate_number }}</td>
                    <td style="font-family:var(--mono);font-size:12px">{{ number_format($vehicle->mileage) }} km</td>
                    <td>
                        @if($vehicle->status === 'active')
                            <span class="badge green">Active</span>
                        @elseif($vehicle->status === 'inactive')
                            <span class="badge red">Inactive</span>
                        @else
                            <span class="badge amber">Pending</span>
                        @endif
                    </td>
                    <td style="display:flex;gap:6px;">
                        <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-ghost" style="padding:4px 10px;font-size:12px">Edit</a>
                        @if(auth()->user()->role === 'admin')
                            <form method="POST" action="{{ route('vehicles.destroy', $vehicle) }}" style="display:inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-ghost" style="padding:4px 10px;font-size:12px;color:#dc2626" onclick="return confirm('Delete this vehicle?')">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;color:var(--muted);padding:20px 0">No vehicles found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection