@extends('layouts.app')

@section('title', 'Vehicle Report')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Vehicle Report</h1>
    <a href="{{ route('reports.vehicles') }}" class="btn btn-outline-secondary">
        <i class="fas fa-sync me-1"></i>Refresh
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h4>All Vehicles Report</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Plate Number</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Mileage</th>
                        <th>Status</th>
                        <th>Maintenance Count</th>
                    </tr>
                </thead>
                <tbody>
                    @if($vehicles->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center text-muted">No vehicles found.</td>
                        </tr>
                    @else
                        @foreach($vehicles as $index => $vehicle)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $vehicle->plate_number }}</td>
                                <td>{{ $vehicle->make }}</td>
                                <td>{{ $vehicle->model }}</td>
                                <td>{{ $vehicle->year }}</td>
                                <td>{{ number_format($vehicle->mileage) }} km</td>
                                <td>
                                    <span class="badge bg-{{ $vehicle->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($vehicle->status) }}
                                    </span>
                                </td>
                                <td>{{ $vehicle->maintenances_count }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection