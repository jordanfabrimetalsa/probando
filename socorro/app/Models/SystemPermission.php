<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemPermission extends Model
{
    protected $fillable = ['name', 'key', 'description'];

    public function roles()
    {
        return $this->belongsToMany(SystemRole::class, 'system_permission_role');
    }
}
