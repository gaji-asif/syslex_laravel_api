<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class CheckAuthenticateUserMiddleware
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
        //session_start();
        //$user_id = Session::get('user_id');
        if (Session()->has('user_id')) {
            return redirect('login');
        }
    }
}
