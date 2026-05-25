@extends('layouts.app')

@section('title', 'Vehicle Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Vehicle Details</h1>
    <div>
        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit me-1"></i>Edit
        </a>
        <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back to List
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Vehicle Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Plate Number:</strong> {{ $vehicle->plate_number }}</p>
                        <p><strong>Make:</strong> {{ $vehicle->make }}</p>
                        <p><strong>Model:</strong> {{ $vehicle->model }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Year:</strong> {{ $vehicle->year }}</p>
                        <p><strong>Mileage:</strong> {{ number_format($vehicle->mileage) }} km</p>
                        <p><strong>Status:</strong> 
                            <span class="badge bg-{{ $vehicle->status === 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($vehicle->status) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>Maintenance History</h4>
            </div>
            <div class="card-body">
                @if($vehicle->maintenances->isEmpty())
                    <p class="text-center text-muted">No maintenance records found.</p>
                @else
                    <div class="list-group">
                        @foreach($vehicle->maintenances->sortByDesc('scheduled_date') as $maintenance)
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $maintenance->type }}</h6>
                                    <small class="text-muted">{{ $maintenance->scheduled_date }}</small>
                                </div>
                                <p class="mb-1">
                                    <span class="badge bg-@if($maintenance->status === 'pending') warning @elseif($maintenance->status === 'completed') success @elseif($maintenance->status === 'overdue') danger @endif">
                                        {{ ucfirst($maintenance->status) }}
                                    </span>
                                </p>
                                @if($maintenance->notes)
                                    <small class="text-muted">{{ $maintenance->notes }}</small>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection