@extends('layouts.app')

@section('title', 'Monthly Maintenance Report')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Monthly Maintenance Report</h1>
    <a href="{{ route('reports.monthly') }}" class="btn btn-outline-secondary">
        <i class="fas fa-sync me-1"></i>Refresh
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h4>Maintenance Count per Month (Last 12 Months)</h4>
    </div>
    <div class="card-body">
        @if($monthlyData->isEmpty())
            <div class="alert alert-info">No maintenance data found for the last 12 months.</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Maintenance Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($monthlyData as $data)
                            <tr>
                                <td>{{ $data->month }}</td>
                                <td>{{ $data->year }}</td>
                                <td>{{ $data->count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection