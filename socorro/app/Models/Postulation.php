<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
    protected $table = 'postulations';

    protected $fillable = [
        'title',
        'description',
        'cant_people_selected',
        'start_date',
        'end_date',
        'delegation_id',
        'status'
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    public function delegation()
    {
        return $this->belongsTo(Delegation::class);
    }

    public function people()
    {
        return $this->hasMany(PostulationsPeople::class, 'postulation_id');
    }
}
