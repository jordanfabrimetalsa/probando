<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendOut extends Model
{
    protected $table = 'notice_departure';

    protected $fillable = [
        'name',
        'lastname',
        'document_type',
        'document_number',
        'email',
        'phone',
        'region',
        'destination',
        'route',
        'file_path',
        'activity',
        'number_participants',
        'departure_date',
        'return_date',
        'active',
        'name_emergency_family',
        'parentesco_family_emergency',
        'number_family_emergency',
        'name_emergency_family_2',
        'parentesco_family_emergency_2',
        'number_family_emergency_2',
    ];
}
