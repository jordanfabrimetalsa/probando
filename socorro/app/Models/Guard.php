<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guard extends Model
{
    protected $table = 'guards';

    protected $fillable = [
        'id_event',
        'id_voluntary',
        'type',
    ];

    public function events()
    {
        return $this->belongsTo(Schedule::class, 'id_event');
    }

    public function voluntaries()
    {
        return $this->belongsTo(Voluntary::class, 'id_voluntary');
    }

    public function voluntary()
    {
        return $this->belongsTo(Voluntary::class, 'id_voluntary');
    }
}
