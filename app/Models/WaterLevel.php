<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterLevel extends Model
{
    use HasFactory;

    protected $table = 'water_level';
    
    protected $fillable = [
        'timestamp',
        'level',
        'unit',
        'sensor_id',
        'tank_id',
    ];

    public $timestamps = false;
}
