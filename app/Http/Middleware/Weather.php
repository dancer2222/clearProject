<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Weather
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('x-csrf-token') !== config('constants.x_csrf_token')) {
            return response()->json('Unauthorized action', Response::HTTP_UNAUTHORIZED);
        };

        return $next($request);
    }
}
