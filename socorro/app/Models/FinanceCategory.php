<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceCategory extends Model
{
    protected $fillable = ['name', 'type', 'color', 'active', 'system_key', 'is_system'];
    protected $casts = ['active' => 'boolean', 'is_system' => 'boolean'];

    public function transactions()
    {
        return $this->hasMany(FinanceTransaction::class);
    }
}
