<?php

namespace App\Http\Middleware;

use App\Enums\UserType;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffUser
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->type !== UserType::Staff) {
            return response()->json([
                'status' => 'error',
                'message' => 'Access denied. Only staff type users are allowed to access this resource.',
            ], 403);
        }
        return $next($request);
    }
}
