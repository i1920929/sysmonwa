<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanque extends Model
{
    use HasFactory;
    
    protected $table = 'tanks';

    protected $fillable = [
        'name',
        'location',
        'capacity',
        'unit',
        'client_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
