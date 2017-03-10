<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth as Auth;
use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('api')->check() && Auth::guard('api')->user()->isAdmin()){
            return $next($request);
        }
        return response()->json(['status' => 'fail', 'message' => 'Only admin can access this.']);
    }
}
