<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockProductAdd extends Model
{
    protected $table = 'stock_products';

    function product(){
        return $this->belongsTo(Product::class);
    }
}
