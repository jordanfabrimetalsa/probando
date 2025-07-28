<?php

namespace App\Models;

use App\Models\Delegation;
use Illuminate\Database\Eloquent\Model;

class CategoryCheck extends Model
{
    protected $table = 'categories_check';

    public function delegation()
    {
        return $this->belongsTo(Delegation::class, 'id_delegation', 'id');
    }
}
