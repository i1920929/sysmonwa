<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $table = 'sensors';

    protected $fillable = ['type', 'tank_id', 'name'];

    // Relación con el tanque
    public function tank()
    {
        return $this->belongsTo(Tanque::class, 'tank_id');
    }
}
