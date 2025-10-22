<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Delegation;

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

    public function delegation()
    {
        return $this->belongsTo(Delegation::class, 'id_delegations');
    }
}
