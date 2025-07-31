<?php

namespace App\Models;

use App\Models\CarModel;
use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    protected $table = 'brand_cars';

    public function models()
    {
        return $this->hasMany(CarModel::class);
    }
}
