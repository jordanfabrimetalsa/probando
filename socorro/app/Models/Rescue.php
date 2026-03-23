<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Voluntary;
use App\Models\User;

class Rescue extends Model
{
    protected $table = 'rescates';

    public function voluntary()
    {
        return $this->belongsTo(Voluntary::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
