<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserLoginCheck
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
        if (!$request->session()->has('user'))
            return redirect()->route('officer.login');
        return $next($request);
    }
}
