<?php

namespace App\Http\Middleware;
use App\User;
use Closure;

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
      //  return "test";

        $user = User::find(session('id'));
        if($user->role){

            return $next($request);
        }
         
         else
         return redirect()->route('service.index');
         
         
            //return view('control_panel.login');//redirect()->route('calender');
       
    }
}
