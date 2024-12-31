<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SchoolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!empty(Auth::check()))
        {
            if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2 || Auth::user()->is_admin == 3)
            {
                return $next($request);
            }
            else
            {
                Auth::logout();
                return redirect(url(''));
            }
            
        }
        else
        {
            Auth::logout();
            return redirect(url(''));
        }
    }
}
