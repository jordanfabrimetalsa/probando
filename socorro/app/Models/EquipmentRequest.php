<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentRequest extends Model
{
    protected $fillable = ['user_id','warehouse_id','delegation_id','purpose','needed_at','expected_return_at','status','reviewed_by','reviewed_at','review_note','returned_at'];
    protected $casts = ['needed_at'=>'date','expected_return_at'=>'date','reviewed_at'=>'datetime','returned_at'=>'datetime'];

    public function items() { return $this->hasMany(EquipmentRequestItem::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function warehouse() { return $this->belongsTo(Warehouse::class); }
    public function reviewer() { return $this->belongsTo(User::class, 'reviewed_by'); }
}
