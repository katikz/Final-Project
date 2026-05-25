<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'plate_number',
        'owner_name',
        'make',
        'model',
        'year',
        'mileage',
        'status'
    ];

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}