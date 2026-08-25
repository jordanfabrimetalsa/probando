<?php

namespace App\Models;

use App\Models\Delegation;
use App\Models\Cargo;
use App\Models\Image_Voluntary;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Voluntary extends Model
{
    protected $table = 'voluntaries';

    protected $fillable = [
        'delegation_id',
        'cargo_id',
        'document',
        'name',
        'lastname',
        'phone',
        'birthday',
        'init_voluntary',
        'address',
        'profession',
        'gender',
        'allergic',
        'disease',
        'medicine',
        'vehicle',
        'license',
        'payment',
        'blood_type',
        'type',
        'status',
        'busy'
    ];

    public function delegation()
    {
        return $this->belongsTo(Delegation::class, 'delegation_id', 'id');
    }

    public function cargo(){
        return $this->belongsTo(Cargo::class, 'cargo_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(Image_Voluntary::class, 'voluntary_id', 'id');
    }

    public function financeTransactions()
    {
        return $this->hasMany(FinanceTransaction::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'voluntary_id');
    }

    public function getImageAttribute()
    {
        $image = $this->images()->first();
        return $image ? '/storage/' . $image->path : '/assets/img/default-avatar.png';
    }
}
