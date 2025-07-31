<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CarBrand;
use App\Models\CarModel;

class Car extends Model
{
    protected $table = 'cars';

    public function brand()
    {
        return $this->belongsTo(CarBrand::class);
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class);
    }
}
