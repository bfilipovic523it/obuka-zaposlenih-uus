<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsPredavac
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->uloga->naziv !== 'Predavac') {
            abort(403);
        }

        return $next($request);
    }
}
