<?php

namespace App\Http\Middleware;

use App\Support\DelegationAccess;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireNationalDelegation
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless(DelegationAccess::isNational($request->user()), 403, 'Esta función está reservada para la Delegación Nacional.');
        return $next($request);
    }
}
