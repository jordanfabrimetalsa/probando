<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image_Voluntary extends Model
{
    protected $table = 'images_voluntaries';
    protected $fillable = [
        'voluntary_id',
        'name',
        'path',
    ];

    public function voluntary()
    {
        return $this->belongsTo(Voluntary::class, 'voluntary_id', 'id');
    }
}
