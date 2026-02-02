<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Voluntary;

class Delegation extends Model
{
    protected $table = 'delegations';

    public function voluntaries()
    {
        return $this->hasMany(Voluntary::class);
    }
}


