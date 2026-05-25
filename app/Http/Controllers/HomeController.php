<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle; // 👈 add this

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function index()
{
    $totalVehicles = Vehicle::count();
    $activeVehicles = Vehicle::where('status', 'active')->count();
    $inactiveVehicles = Vehicle::where('status', 'inactive')->count();
    $newThisMonth = Vehicle::whereMonth('created_at', now()->month)->count();
    $pendingMaintenance = \App\Models\Maintenance::where('status', 'pending')->count();
    $overdueMaintenance = \App\Models\Maintenance::where('status', '!=', 'completed')
                            ->where('scheduled_date', '<', now())->count();
    $recentVehicles = Vehicle::with('maintenances')->latest()->take(5)->get();
    $upcomingMaintenance = \App\Models\Maintenance::with('vehicle')
                            ->where('status', '!=', 'completed')
                            ->where('scheduled_date', '>=', now())
                            ->orderBy('scheduled_date')->take(5)->get();
    $alerts = [];

    return view('dashboard', compact(
        'totalVehicles', 'activeVehicles', 'inactiveVehicles',
        'newThisMonth', 'pendingMaintenance', 'overdueMaintenance',
        'recentVehicles', 'upcomingMaintenance', 'alerts'
    ));
}
}