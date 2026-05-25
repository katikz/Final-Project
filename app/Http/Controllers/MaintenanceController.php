<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::with('vehicle')->get();
        return view('maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        $vehicles = Vehicle::where('status', 'active')->get();
        return view('maintenances.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id'     => 'required|exists:vehicles,id',
            'type'           => 'required|string|max:100',
            'scheduled_date' => 'required|date|after_or_equal:today',
            'status'         => 'required|in:pending,completed,overdue',
            'notes'          => 'nullable|string',
        ]);

        Maintenance::create($request->all());

        return redirect()->route('maintenance.index')
            ->with('success', 'Maintenance scheduled successfully.');
    }

    public function show(Maintenance $maintenance)
    {
        return view('maintenances.show', compact('maintenance'));
    }

    public function edit(Maintenance $maintenance)
    {
        $vehicles = Vehicle::where('status', 'active')->get();
        return view('maintenances.edit', compact('maintenance', 'vehicles'));
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'vehicle_id'     => 'required|exists:vehicles,id',
            'type'           => 'required|string|max:100',
            'scheduled_date' => 'required|date',
            'status'         => 'required|in:pending,completed,overdue',
            'notes'          => 'nullable|string',
        ]);

        $maintenance->update($request->all());

        return redirect()->route('maintenance.index')
            ->with('success', 'Maintenance updated successfully.');
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();

        return redirect()->route('maintenance.index')
            ->with('success', 'Maintenance record deleted successfully.');
    }
}