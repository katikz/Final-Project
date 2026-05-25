@extends('layouts.app')

@section('title', 'Reports')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-label">Total Vehicles</span>
            <div class="stat-icon blue"><i class="ti ti-car"></i></div>
        </div>
        <div class="stat-value">{{ $totalVehicles }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-label">Total Maintenances</span>
            <div class="stat-icon blue"><i class="ti ti-tools"></i></div>
        </div>
        <div class="stat-value">{{ $totalMaintenances }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-label">Completed</span>
            <div class="stat-icon green"><i class="ti ti-check"></i></div>
        </div>
        <div class="stat-value">{{ $completedMaintenances }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-label">Overdue</span>
            <div class="stat-icon red"><i class="ti ti-alert-triangle"></i></div>
        </div>
        <div class="stat-value">{{ $overdueMaintenances }}</div>
    </div>
</div>

<div class="card">
    <div class="card-header" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;">
        <span class="card-title">Recent Maintenance Records</span>
        <div style="display:flex; gap:8px;">
            <a href="{{ route('reports.export.excel') }}"
               style="display:inline-flex; align-items:center; gap:6px; padding:8px 16px; background:#1D6F42; color:#fff; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none;"
               onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                <i class="ti ti-table-export" style="font-size:16px;"></i> Export Excel
            </a>
            <a href="{{ route('reports.export.pdf') }}"
               style="display:inline-flex; align-items:center; gap:6px; padding:8px 16px; background:#C0392B; color:#fff; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none;"
               onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                <i class="ti ti-file-type-pdf" style="font-size:16px;"></i> Export PDF
            </a>
        </div>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Vehicle</th>
                    <th>Type</th>
                    <th>Scheduled Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentMaintenances as $maintenance)
                <tr>
                    <td>
                        <div class="vehicle-name">{{ $maintenance->vehicle->make ?? '' }} {{ $maintenance->vehicle->model ?? '' }}</div>
                        <div class="plate">{{ $maintenance->vehicle->plate_number ?? 'N/A' }}</div>
                    </td>
                    <td style="font-size:12px">{{ $maintenance->type }}</td>
                    <td style="font-size:12px;color:var(--muted)">{{ $maintenance->scheduled_date }}</td>
                    <td>
                        @if($maintenance->status === 'completed')
                            <span class="badge green">Completed</span>
                        @elseif($maintenance->status === 'overdue')
                            <span class="badge red">Overdue</span>
                        @else
                            <span class="badge amber">Pending</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center;color:var(--muted);padding:20px 0">No records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection