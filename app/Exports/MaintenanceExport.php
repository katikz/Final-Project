<?php

namespace App\Exports;

use App\Models\Maintenance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MaintenanceExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return Maintenance::with('vehicle')->get()->map(function ($m) {
            return [
                'Vehicle'        => ($m->vehicle->make ?? '') . ' ' . ($m->vehicle->model ?? ''),
                'Plate Number'   => $m->vehicle->plate_number ?? 'N/A',
                'Type'           => $m->type,
                'Scheduled Date' => optional($m->scheduled_date)->format('Y-m-d') ?? $m->scheduled_date,
                'Status'         => ucfirst($m->status),
            ];
        });
    }

    public function headings(): array
    {
        return ['Vehicle', 'Plate Number', 'Type', 'Scheduled Date', 'Status'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill'      => ['fillType' => 'solid', 'startColor' => ['rgb' => '1D6F42']],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 15,
            'C' => 20,
            'D' => 18,
            'E' => 12,
        ];
    }
}