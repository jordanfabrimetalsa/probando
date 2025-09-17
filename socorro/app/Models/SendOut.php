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
        'return_date'
    ];
}
