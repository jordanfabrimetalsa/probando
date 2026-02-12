<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostulationsPeople extends Model
{
    protected $table = 'postulations_people';

    protected $fillable = [
        'name',
        'last_name',
        'rut',
        'phone',
        'email',
        'presentation',
        'postulation_id'
    ];

    public function postulation(){
        return $this->belongsTo(Postulation::class);
    }
}
