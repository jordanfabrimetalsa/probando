<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    protected $fillable = [
        'barcode',
        'name',
        'description',
        'colour',
        'size',
        'brand',
        'stock',
        'status',
        'id_category',
        'id_warehouse',
        'image'
    ];

    public function warehouse() { return $this->belongsTo(Warehouse::class, 'id_warehouse'); }
    public function movements() { return $this->hasMany(StockMovement::class); }
}
