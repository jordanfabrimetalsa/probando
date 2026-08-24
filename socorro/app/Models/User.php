<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'rut',
        'password',
        'role',
        'status',
        'voluntary_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function systemRole()
    {
        return $this->belongsTo(SystemRole::class, 'role', 'slug');
    }

    public function voluntary()
    {
        return $this->belongsTo(Voluntary::class, 'voluntary_id');
    }

    public function hasPermission(string $permission): bool
    {
        if ($this->role === 'admin') return true;

        return $this->systemRole()
            ->where('active', true)
            ->whereHas('permissions', fn ($query) => $query->where('key', $permission))
            ->exists();
    }
}
