<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Token;
use App\User;

class CheckAuth
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

        $login = new Token($request);

        $mailReceived = $login->decoder();

        $data = ['email' => $mailReceived];

        $mailExpected = User::where($data)->first();

        if ($mailExpected->email) {
            return $next($request);
        }

        return response()->json([
            'message' => "Acceso no autorizado.",
        ], 401);
    }
}
