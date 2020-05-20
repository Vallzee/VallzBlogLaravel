<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
        //check if user is logged in
        if(Auth::check()){
            //check if the logged in user is an admin
            if(Auth::user()->isAdmin() && Auth::user()->isActive()){
                //everything went through, return the next request
                //echo "Admin Middleware applied here";
                return $next($request);
            }else{
                //echo "Logged in but not admin";
                return redirect('/home');
            }
        }else{
            //if user is not logged in return to home page
            return redirect('/');
        }

    }
}
