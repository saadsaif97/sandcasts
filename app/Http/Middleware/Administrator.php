<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Administrator
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

        if (auth()->check()) 
        {

            if(in_array(auth()->user()->email,config('app.admins')))
            {
                return $next($request);
            }
        }

        return redirect('/');
    }
}
