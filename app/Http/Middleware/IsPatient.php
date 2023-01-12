<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsPatient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->is_admin || auth()->user()->is_doctor) {
            // redirect to admin route
            return redirect()->route('admin.home');
        }
        return $next($request);
    }
}
