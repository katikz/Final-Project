@extends('layouts.app')

@section('title', 'Maintenance Cost Report')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Maintenance Cost Report</h1>
    <a href="{{ route('reports.costs') }}" class="btn btn-outline-secondary">
        <i class="fas fa-sync me-1"></i>Refresh
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h4>Maintenance Frequency per Vehicle</h4>
        <p class="text-muted mb-0">Number of maintenance records per vehicle (sorted by frequency)</p>
    </div>
    <div class="card-body">
        @if($costData->isEmpty())
            <div class="alert alert-info">No maintenance data found.</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Plate Number</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Total Maintenance Records</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($costData as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->plate_number }}</td>
                                <td>{{ $data->make }}</td>
                                <td>{{ $data->model }}</td>
                                <td>{{ $data->total_maintenances }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection