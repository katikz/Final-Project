@extends('layouts.app')

@section('title', 'Maintenance Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Maintenance Details</h1>
    <div>
        <a href="{{ route('maintenances.edit', $maintenance->id) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit me-1"></i>Edit
        </a>
        <a href="{{ route('maintenances.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back to List
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Maintenance Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Vehicle:</strong> {{ $maintenance->vehicle->plate_number }} - {{ $maintenance->vehicle->make }} {{ $maintenance->vehicle->model }}</p>
                        <p><strong>Maintenance Type:</strong> {{ $maintenance->type }}</p>
                        <p><strong>Scheduled Date:</strong> {{ $maintenance->scheduled_date }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Completed Date:</strong> {{ $maintenance->completed_date ?? '<span class="text-muted">Not completed</span>' }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge bg-@if($maintenance->status === 'pending') warning @elseif($maintenance->status === 'completed') success @elseif($maintenance->status === 'overdue') danger @endif">
                                {{ ucfirst($maintenance->status) }}
                            </span>
                        </p>
                    </div>
                </div>
                @if($maintenance->notes)
                    <div class="mt-3">
                        <p><strong>Notes:</strong></p>
                        <p>{{ $maintenance->notes }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection