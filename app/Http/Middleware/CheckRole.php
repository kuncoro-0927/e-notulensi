<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if ($request->user() && in_array($request->user()->role_id, $roles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
