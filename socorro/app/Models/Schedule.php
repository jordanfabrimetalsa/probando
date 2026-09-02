<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'events';

    protected $fillable = ['title', 'description', 'type', 'start', 'end', 'guard_enabled', 'guard_capacity', 'guard_leader_id'];

    protected function casts(): array
    {
        return ['guard_enabled' => 'boolean'];
    }

    public function guards()
    {
        return $this->hasMany(Guard::class, 'id_event');
    }

    public function guardLeader()
    {
        return $this->belongsTo(Voluntary::class, 'guard_leader_id');
    }
}
