<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemRole extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'is_system', 'active'];

    protected function casts(): array
    {
        return ['is_system' => 'boolean', 'active' => 'boolean'];
    }

    public function permissions()
    {
        return $this->belongsToMany(SystemPermission::class, 'system_permission_role');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role', 'slug');
    }
}
