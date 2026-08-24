<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class DelegationAccess
{
    public static function id(?User $user = null): ?int
    {
        $user ??= auth()->user();
        return $user?->voluntary?->delegation_id;
    }

    public static function isNational(?User $user = null): bool
    {
        $user ??= auth()->user();
        return (bool) $user?->voluntary?->delegation?->is_national;
    }

    public static function scope(Builder|QueryBuilder $query, string $column = 'delegation_id', ?User $user = null): Builder|QueryBuilder
    {
        return self::isNational($user) ? $query : $query->where($column, self::id($user) ?? 0);
    }

    public static function authorize(int $delegationId, ?User $user = null): void
    {
        abort_unless(self::isNational($user) || self::id($user) === $delegationId, 403, 'No puede acceder a información de otra delegación.');
    }
}
