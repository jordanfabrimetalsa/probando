<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileSchedule extends Model
{
    protected $table = 'file_schedule';
    protected $fillable = [
        'name',
        'path',
        'type',
        'event_id',
    ];

    public function event()
    {
        return $this->belongsTo(Schedule::class);
    }
}
