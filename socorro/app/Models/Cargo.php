<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargos';
    protected $fillable = ['nombre'];

    public function voluntaries()
    {
        return $this->hasMany(Voluntary::class, 'cargo_id');
    }
}
