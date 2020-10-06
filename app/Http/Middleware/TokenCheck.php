<?php

namespace App\Http\Middleware;

use App\DtbUser;
use Closure;

class TokenCheck
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

        $token = $request->header('token');
        //dd($token);
        $user = DtbUser::select('email')->where('api_token', $token)->first();
        //dd($user);
        if (!is_null($user)) {
            //dd("dsjshd");
            return $next($request);
        } else if (is_null($user)) {
            return response()->json([
                'message' => 'Invalid token',
            ], 401);
        }
        //return $next($request);
        //
    }
}
