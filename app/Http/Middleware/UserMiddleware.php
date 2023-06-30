<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
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
        if(\Auth::check()){

            if(\Auth::user()->user_type == 'user' || \Auth::user()->user_type == 'admin'){
                return $next($request);
            }
            else {
                return redirect('/');
            }


        }
        else {
            return redirect('/')->with('message', 'Ne moze bez sifre');
        }
    }
}
