<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (! auth()->check() || auth()->user()->username !== 'admin') {
            abort(403, 'ayaw kol! ikaw jd kol.'); // You are not authorized to access this page.
        }

        return $next($request);
    }
}
