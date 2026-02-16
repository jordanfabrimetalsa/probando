<?php

namespace App\Models;

use App\Models\Delegation;
use Illuminate\Database\Eloquent\Model;

class Voluntary extends Model
{
    protected $table = 'voluntaries';

    protected $fillable = [
        'delegation_id',
        'document',
        'name',
        'lastname',
        'phone',
        'birthday',
        'address',
        'profession',
        'gender',
        'allergic',
        'disease',
        'medicine',
        'vehicle',
        'license',
        'payment',
        'blood_type',
        'type',
        'status',
        'busy'
    ];

    public function delegation()
    {
        return $this->belongsTo(Delegation::class, 'delegation_id', 'id');
    }
}
