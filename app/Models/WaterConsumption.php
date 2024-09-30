<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterConsumption extends Model
{
    protected $table = 'water_consumption';
    
    protected $fillable = [
        'timestamp',
        'consumption_volume',
        'unit',
        'sensor_id',
        'tank_id',
        'client_id',
        'flow_rate',
        'created_at',
        'updated_at'
    ];

    public $timestamps = false;
}
