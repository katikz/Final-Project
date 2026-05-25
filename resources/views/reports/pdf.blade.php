<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
  body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111; margin: 30px; }
  h2 { color: #1E3A8A; margin-bottom: 4px; }
  p.sub { color: #6B7280; font-size: 10px; margin: 0 0 20px; }
  table { width: 100%; border-collapse: collapse; margin-top: 8px; }
  .stats-table td { border: 1px solid #E5E7EB; padding: 12px 16px; text-align: center; width: 25%; }
  .stats-table .num { font-size: 22px; font-weight: bold; color: #1E3A8A; }
  .stats-table .lbl { font-size: 10px; color: #6B7280; margin-top: 2px; }
  .main-table thead tr { background: #1E3A8A; color: #fff; }
  .main-table thead th { padding: 9px 12px; text-align: left; font-size: 11px; letter-spacing: 0.5px; }
  .main-table tbody tr:nth-child(even) { background: #F8FAFF; }
  .main-table tbody td { padding: 8px 12px; border-bottom: 1px solid #E5E7EB; font-size: 11px; }
  .completed { color: #065F46; font-weight: bold; }
  .overdue   { color: #991B1B; font-weight: bold; }
  .pending   { color: #92400E; font-weight: bold; }
  .footer { margin-top: 30px; font-size: 10px; color: #9CA3AF; text-align: right; }
</style>
</head>
<body>

<h2>FleetSync — Maintenance Report</h2>
<p class="sub">Generated on {{ now()->format('F d, Y \a\t h:i A') }}</p>

<table class="stats-table" style="margin-bottom:20px;">
  <tr>
    <td>
      <div class="num">{{ $totalVehicles }}</div>
      <div class="lbl">Total Vehicles</div>
    </td>
    <td>
      <div class="num">{{ $totalMaintenances }}</div>
      <div class="lbl">Total Maintenances</div>
    </td>
    <td>
      <div class="num" style="color:#065F46;">{{ $completedMaintenances }}</div>
      <div class="lbl">Completed</div>
    </td>
    <td>
      <div class="num" style="color:#991B1B;">{{ $overdueMaintenances }}</div>
      <div class="lbl">Overdue</div>
    </td>
  </tr>
</table>

<table class="main-table">
  <thead>
    <tr>
      <th>Vehicle</th>
      <th>Owner Name</th>
      <th>Plate No.</th>
      <th>Type</th>
      <th>Scheduled Date</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    @forelse($recentMaintenances as $m)
    <tr>
      <td>{{ ($m->vehicle->make ?? '') }} {{ ($m->vehicle->model ?? '') }}</td>
      <td>{{ $m->vehicle->owner_name ?? 'N/A' }}</td>
      <td>{{ $m->vehicle->plate_number ?? 'N/A' }}</td>
      <td>{{ $m->type }}</td>
      <td>{{ $m->scheduled_date }}</td>
      <td>
        @if($m->status === 'completed')
          <span class="completed">Completed</span>
        @elseif($m->status === 'overdue')
          <span class="overdue">Overdue</span>
        @else
          <span class="pending">Pending</span>
        @endif
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="6" style="text-align:center; color:#9CA3AF; padding:16px 0;">No records found.</td>
    </tr>
    @endforelse
  </tbody>
</table>

<div class="footer">FleetSync Portal &mdash; Confidential</div>

</body>
</html>