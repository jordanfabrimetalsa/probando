<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use SoftDeletes;
    protected $table = 'warehouses';
    protected $fillable = ['name', 'description', 'path', 'status', 'delegation_id'];
    public function delegation() { return $this->belongsTo(Delegation::class); }
}
