<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserLogoutCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('user'))
            return redirect()->route('officer.dashboard');
        return $next($request);
    }
}
