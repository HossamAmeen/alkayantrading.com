<?php

namespace App\Http\Middleware;

use Closure;

class Manager
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
      //  return "test";
        if(session('id')){

            return $next($request);
        }
         
         else
         return redirect()->route('login');
         
         
            //return view('control_panel.login');//redirect()->route('calender');
       
    }
}
