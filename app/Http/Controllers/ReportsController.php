<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Maintenance;
use App\Exports\MaintenanceExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        $totalVehicles         = Vehicle::count();
        $totalMaintenances     = Maintenance::count();
        $completedMaintenances = Maintenance::where('status', 'completed')->count();
        $overdueMaintenances   = Maintenance::where('status', 'overdue')->count();
        $recentMaintenances    = Maintenance::with('vehicle')
                                    ->latest()
                                    ->take(10)
                                    ->get();

        return view('reports.index', compact(
            'totalVehicles',
            'totalMaintenances',
            'completedMaintenances',
            'overdueMaintenances',
            'recentMaintenances'
        ));
    }

    public function exportExcel()
    {
        return Excel::download(
            new MaintenanceExport,
            'maintenance-report-' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    public function exportPdf()
    {
        $totalVehicles         = Vehicle::count();
        $totalMaintenances     = Maintenance::count();
        $completedMaintenances = Maintenance::where('status', 'completed')->count();
        $overdueMaintenances   = Maintenance::where('status', 'overdue')->count();
        $recentMaintenances    = Maintenance::with('vehicle')->latest()->get();

        $pdf = Pdf::loadView('reports.pdf', compact(
            'totalVehicles',
            'totalMaintenances',
            'completedMaintenances',
            'overdueMaintenances',
            'recentMaintenances'
        ))->setPaper('a4', 'landscape');

        return $pdf->download('maintenance-report-' . now()->format('Y-m-d') . '.pdf');
    }

    // Required by Route::resource
    public function create() {}
    public function store(Request $request) {}
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}