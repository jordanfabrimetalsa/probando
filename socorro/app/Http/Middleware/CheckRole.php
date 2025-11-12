<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            abort(403, 'Debe iniciar sesión para acceder.');
        }

        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'No tiene permisos para acceder a esta sección.');
        }
        return $next($request);
    }
}
