<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'events';

    protected $fillable = ['title', 'description', 'type', 'start', 'end'];
}
