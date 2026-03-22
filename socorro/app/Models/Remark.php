<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Remark extends Model
{
    protected $table = 'remarks';

    public function user(){
        return $this->belongsTo(User::class, 'responsable_id', 'id');
    }
}
