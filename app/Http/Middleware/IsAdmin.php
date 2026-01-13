<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->uloga->naziv !== 'Administrator') {
            abort(403);
        }

        return $next($request);
    }
}
