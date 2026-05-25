@extends('layouts.app')

@section('title', 'Maintenance')

@section('topbar-actions')
    <a href="{{ route('maintenance.create') }}" class="btn btn-primary">
        <i class="ti ti-plus" style="font-size:14px"></i> Schedule Maintenance
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">Maintenance Records</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Vehicle</th>
                    <th>Type</th>
                    <th>Scheduled Date</th>
                    <th>Completed Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($maintenances as $maintenance)
                <tr>
                    <td>
                        <div class="vehicle-name">{{ $maintenance->vehicle->make ?? '' }} {{ $maintenance->vehicle->model ?? '' }}</div>
                        <div class="plate">{{ $maintenance->vehicle->plate_number ?? 'N/A' }}</div>
                    </td>
                    <td style="font-size:12px">{{ $maintenance->type }}</td>
                    <td style="font-size:12px;color:var(--muted)">
                        {{ $maintenance->scheduled_date ? $maintenance->scheduled_date->format('M d, Y') : '—' }}
                    </td>
                    <td style="font-size:12px;color:var(--muted)">
                        {{ $maintenance->completed_date ? $maintenance->completed_date->format('M d, Y') : '—' }}
                    </td>
                    <td>
                        @if($maintenance->status === 'completed')
                            <span class="badge green">Completed</span>
                        @elseif($maintenance->status === 'overdue')
                            <span class="badge red">Overdue</span>
                        @else
                            <span class="badge amber">Pending</span>
                        @endif
                    </td>
                    <td style="display:flex;gap:6px;">
                        <a href="{{ route('maintenance.edit', $maintenance->id) }}" class="btn btn-ghost" style="padding:4px 10px;font-size:12px">Edit</a>
                        @if(auth()->user()->role === 'admin')
                            <form method="POST" action="{{ route('maintenance.destroy', $maintenance->id) }}" style="display:inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-ghost" style="padding:4px 10px;font-size:12px;color:#dc2626" onclick="return confirm('Delete this record?')">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:var(--muted);padding:20px 0">No maintenance records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection