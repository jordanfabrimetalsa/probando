<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceTransaction extends Model
{
    protected $fillable = ['finance_category_id', 'user_id', 'voluntary_id', 'delegation_id', 'transaction_date', 'amount', 'counterparty', 'description', 'reference', 'notes'];
    protected $casts = ['transaction_date' => 'date', 'amount' => 'decimal:2'];

    public function category()
    {
        return $this->belongsTo(FinanceCategory::class, 'finance_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voluntary()
    {
        return $this->belongsTo(Voluntary::class);
    }

    public function delegation()
    {
        return $this->belongsTo(Delegation::class);
    }

    protected static function booted(): void
    {
        static::creating(function (FinanceTransaction $transaction) {
            if (!$transaction->delegation_id) {
                $transaction->delegation_id = $transaction->voluntary?->delegation_id
                    ?? $transaction->user?->voluntary?->delegation_id;
            }
        });
    }
}
