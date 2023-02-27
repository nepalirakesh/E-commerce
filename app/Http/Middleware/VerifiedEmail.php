<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifiedEmail
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
        
       if(Auth::guest()){
        return redirect()->route('login');
       }
        if(!Auth::user()->is_email_verified){
            return redirect()->route('home')->with('success','Email address not verified. Firstly verify your email address with the verification link sent during account registration, then you may proceed.');
        }
        return $next($request);
    }
}
