<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsZaposleni
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->uloga->naziv !== 'Zaposleni') {
            abort(403);
        }

        return $next($request);
    }
}
