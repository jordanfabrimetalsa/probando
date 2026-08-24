<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $table = 'stock_movement';
    protected $fillable = ['type', 'quantity', 'balance_before', 'balance_after', 'unit_cost', 'reason', 'reference', 'occurred_at', 'product_id', 'warehouse_id', 'delegation_id', 'user_id'];
    protected $casts = ['occurred_at' => 'datetime'];

    public function product() { return $this->belongsTo(Product::class)->withTrashed(); }
    public function warehouse() { return $this->belongsTo(Warehouse::class)->withTrashed(); }
    public function user() { return $this->belongsTo(User::class); }
    public function delegation() { return $this->belongsTo(Delegation::class); }

    protected static function booted(): void
    {
        static::creating(function (StockMovement $movement) {
            $movement->delegation_id ??= $movement->warehouse?->delegation_id;
        });
    }
}
