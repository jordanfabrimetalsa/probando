<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BossEvent extends Model
{
    protected $table = 'boss_event';
    protected $fillable = ['id_event', 'id_user', 'type'];

    public function event()
    {
        return $this->belongsTo(Schedule::class, 'id_event');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
