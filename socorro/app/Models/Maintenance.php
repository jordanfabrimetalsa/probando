<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenance';
    
    protected $fillable = [
        'kilometer',
        'place',
        'cost',
        'date',
        'car_id'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
