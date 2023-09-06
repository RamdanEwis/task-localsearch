<?php

namespace App\Http\Middleware;

use App\Enum\UserType;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->type !== UserType::SUPER_ADMIN->value) {
            abort(403, );
        }

        return $next($request);
    }
}
