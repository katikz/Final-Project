
@extends('layouts.app')

@section('title', 'Dashboard')

@section('topbar-actions')
    <a href="{{ route('vehicles.create') }}" class="btn btn-primary">
        <i class="ti ti-plus" style="font-size:14px"></i> Add Vehicle
    </a>
@endsection

@section('content')

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-label">Total Vehicles</span>
            <div class="stat-icon blue"><i class="ti ti-car"></i></div>
        </div>
        <div class="stat-value">{{ $totalVehicles }}</div>
        <div class="stat-footer">
            <span class="trend up">↑ {{ $newThisMonth }}</span>
            <span class="trend-label">added this month</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-label">Active Vehicles</span>
            <div class="stat-icon green"><i class="ti ti-check"></i></div>
        </div>
        <div class="stat-value">{{ $activeVehicles }}</div>
        <div class="stat-footer">
            <span class="trend up">
                {{ $totalVehicles > 0 ? round(($activeVehicles / $totalVehicles) * 100) : 0 }}%
            </span>
            <span class="trend-label">utilization</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-label">Pending Tasks</span>
            <div class="stat-icon amber"><i class="ti ti-clock"></i></div>
        </div>
        <div class="stat-value">{{ str_pad($pendingMaintenance, 2, '0', STR_PAD_LEFT) }}</div>
        <div class="stat-footer">
            <span class="trend-label">awaiting service</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-label">Overdue</span>
            <div class="stat-icon red"><i class="ti ti-alert-triangle"></i></div>
        </div>
        <div class="stat-value">{{ str_pad($overdueMaintenance, 2, '0', STR_PAD_LEFT) }}</div>
        <div class="stat-footer">
            <span class="trend down">needs attention</span>
        </div>
    </div>
</div>

<div class="two-col">
    <div style="display:flex;flex-direction:column;gap:16px;">

        {{-- Recent Vehicles --}}
        <div class="card">
            <div class="card-header">
                <span class="card-title">Recent Vehicles</span>
                <a href="{{ route('vehicles.index') }}" class="card-action">Manage all →</a>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Mileage</th>
                            <th>Last Service</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentVehicles as $vehicle)
                        <tr>
                            <td>
                                <div class="vehicle-name">{{ $vehicle->make }} {{ $vehicle->model }}</div>
                                <div class="plate">{{ $vehicle->plate_number }}</div>
                            </td>
                            <td style="font-family:var(--mono);font-size:12px">
                                {{ number_format($vehicle->mileage) }} km
                            </td>
                            <td style="font-size:12px;color:var(--muted)">
                            {{ $vehicle->maintenances->last() ? \Carbon\Carbon::parse($vehicle->maintenances->last()->scheduled_date)->format('M d, Y') : 'No record' }}
                            </td>
                            <td>
                                @if($vehicle->status === 'active')
                                    <span class="badge green">Active</span>
                                @elseif($vehicle->status === 'inactive')
                                    <span class="badge red">Inactive</span>
                                @else
                                    <span class="badge amber">Pending</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center;color:var(--muted);padding:20px 0">
                                No vehicles found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Upcoming Maintenance --}}
        <div class="card">
            <div class="card-header">
                <span class="card-title">Upcoming Maintenance</span>
                <a href="{{ route('maintenance.index') }}" class="card-action">View all →</a>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Type</th>
                            <th>Scheduled</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($upcomingMaintenance as $task)
                        <tr>
                            <td>
                                <div class="vehicle-name">{{ $task->vehicle->make }} {{ $task->vehicle->model }}</div>
                                <div class="plate">{{ $task->vehicle->plate_number }}</div>
                            </td>
                            <td style="font-size:12px">{{ $task->maintenance_type }}</td>
                            <td style="font-size:12px;color:var(--muted)">
                                {{ $task->scheduled_date->format('M d, Y') }}
                            </td>
                            <td>
                                @if($task->status === 'completed')
                                    <span class="badge green">Done</span>
                                @elseif($task->scheduled_date->isPast())
                                    <span class="badge red">Overdue</span>
                                @else
                                    <span class="badge amber">Pending</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center;color:var(--muted);padding:20px 0">
                                No upcoming tasks.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div style="display:flex;flex-direction:column;gap:16px;">

        {{-- Fleet Status --}}
        <div class="card">
            <div class="card-header">
                <span class="card-title">Fleet Status</span>
            </div>
            <div class="fleet-wrap">
                <div class="fleet-row">
                    <span class="fleet-label">Active</span>
                    <div class="fleet-bar-bg">
                        <div class="fleet-bar" style="width:{{ $totalVehicles > 0 ? round(($activeVehicles/$totalVehicles)*100) : 0 }}%;background:#1a56db"></div>
                    </div>
                    <span class="fleet-count">{{ $activeVehicles }}</span>
                </div>
                <div class="fleet-row">
                    <span class="fleet-label">Pending</span>
                    <div class="fleet-bar-bg">
                        <div class="fleet-bar" style="width:{{ $totalVehicles > 0 ? round(($pendingMaintenance/$totalVehicles)*100) : 0 }}%;background:#f59e0b"></div>
                    </div>
                    <span class="fleet-count">{{ $pendingMaintenance }}</span>
                </div>
                <div class="fleet-row">
                    <span class="fleet-label">Overdue</span>
                    <div class="fleet-bar-bg">
                        <div class="fleet-bar" style="width:{{ $totalVehicles > 0 ? round(($overdueMaintenance/$totalVehicles)*100) : 0 }}%;background:#ef4444"></div>
                    </div>
                    <span class="fleet-count">{{ $overdueMaintenance }}</span>
                </div>
                <div class="fleet-row">
                    <span class="fleet-label">Inactive</span>
                    <div class="fleet-bar-bg">
                        <div class="fleet-bar" style="width:{{ $totalVehicles > 0 ? round(($inactiveVehicles/$totalVehicles)*100) : 0 }}%;background:#9ca3af"></div>
                    </div>
                    <span class="fleet-count">{{ $inactiveVehicles }}</span>
                </div>
            </div>
        </div>

        {{-- Alerts --}}
        <div class="card">
            <div class="card-header">
                <span class="card-title">Alerts</span>
                @if($overdueMaintenance > 0)
                    <span class="badge red">{{ $overdueMaintenance }} overdue</span>
                @endif
            </div>
            <div class="alerts-list">
                @forelse($alerts as $alert)
                <div class="alert-item">
                    <div class="alert-dot {{ $alert['type'] }}"></div>
                    <div>
                        <div class="alert-text">{{ $alert['message'] }}</div>
                        <div class="alert-meta">{{ $alert['meta'] }}</div>
                    </div>
                </div>
                @empty
                <div style="padding:16px 0;text-align:center;color:var(--muted);font-size:13px">
                    All clear — no alerts!
                </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

@endsection