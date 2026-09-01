<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAnyPermission
{
    public function handle(Request $request, Closure $next, string ...$permissions): Response
    {
        $allowed = collect($permissions)->contains(fn ($permission) => $request->user()?->hasPermission($permission));
        abort_unless($allowed, 403, 'No tiene permisos para acceder a esta sección.');

        return $next($request);
    }
}
