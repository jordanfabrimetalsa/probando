<?php

namespace App\Models;

use App\Models\Delegation;
use Illuminate\Database\Eloquent\Model;

class Voluntary extends Model
{
    protected $table = 'voluntaries';

    public function delegation()
    {
        return $this->belongsTo(Delegation::class, 'delegation_id', 'id');
    }
}
