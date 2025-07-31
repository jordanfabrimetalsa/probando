<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CarBrand;

class CarModel extends Model
{
    protected $table = 'model_cars';

    public function brand()
    {
        return $this->belongsTo(CarBrand::class);
    }
}
