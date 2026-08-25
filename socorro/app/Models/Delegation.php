<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Voluntary;

class Delegation extends Model
{
    protected $table = 'delegations';

    protected $fillable = ['name', 'region_id', 'image', 'postulation_status', 'is_national'];

    protected $casts = ['is_national' => 'boolean'];

    public function voluntaries()
    {
        return $this->hasMany(Voluntary::class);
    }

    public function region()
    {
        return $this->belongsTo(Regions::class, 'region_id');
    }

    public function postulations()
    {
        return $this->hasMany(Postulation::class);
    }
}
