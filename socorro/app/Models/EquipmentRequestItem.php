<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentRequestItem extends Model
{
    protected $fillable = ['equipment_request_id','product_id','quantity','returned_quantity'];
    public function request() { return $this->belongsTo(EquipmentRequest::class, 'equipment_request_id'); }
    public function product() { return $this->belongsTo(Product::class); }
}
