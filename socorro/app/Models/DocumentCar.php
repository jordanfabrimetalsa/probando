<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentCar extends Model
{
    protected $table = 'document_car';
    
    protected $fillable = [
        'circulation_permit',
        'gases',
        'technical_inspection',
        'insurance',
        'car_id'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
