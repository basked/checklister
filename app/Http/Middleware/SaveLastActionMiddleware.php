<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SaveLastActionMiddleware
{

    public function handle(Request $request, Closure $next)
    {

        return $next($request);
    }

    public function tetminate($request, $response)
    {
        if ($request->user()) {
            $request->user()->update(['last_action_at' => now()]);
        }
    }
}
