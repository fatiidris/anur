<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Symfony\Component\HttpFoundation\Response;

class CommomMiddleware
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
            return $next($request);
        }
        else
        {
            Auth::logout();
            return redirect( url (''));
        }
    }
}
