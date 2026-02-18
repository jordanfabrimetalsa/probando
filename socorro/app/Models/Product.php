<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
}
