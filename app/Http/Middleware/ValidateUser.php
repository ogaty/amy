<?php

namespace App\Http\Middleware;

use Closure;
use \App\User;
use \App\Eloquent\UsersToken;
use Illuminate\Support\Facades\Log;

class ValidateUser
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
        $users = new User();
        $tokenModel = new UsersToken();
        $user_id = $request->header('USER-ID');
        $token = $request->header('TOKEN');
        $token_id = $request->header('TOKEN-ID');

        $loginuser = $users->findOrFail($user_id);
        $logintoken = $tokenModel->findOrFail($token_id);
        if ($token != $logintoken->token) {
            abort(403);
        }

        return $next($request);
    }
}
