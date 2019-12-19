<?php

namespace App\Helpers;

use \Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Request;

class Token
{
    private $key = 'GcFr@_4^fW3Bs3^LScNzGdfx?6yd8fe-gXYb!86GVQS+Nk$yqAza@Xz+E@5MV+yda=k7GtAy2CmnSkxBdq3Fr=hVjmLUJ6aSHY8ZWMP*w=H&Q7+Kq6Ex#VrmLC@jVU9ExX8a!m-JYDXXjm37S%Q=m4%9s8V5gKx6N8_QQ!_%W7U=_VStzSQvB^asFdrk%2Yj!9S4_dsV9^GwH^!YLpYyX#6HaD7RSCVwuZZ_2Dmww_t%TT6wXrBKqssKAtEt@Lr^';
    private $cipher = array('HS256');

    function __construct(Request $request)
    {
        $this->token = $request->header('token');
        $this->email = $request->email;
    }

    public function encoder()
    {
        $token = JWT::encode($this->email, $this->key);

        return response()->json([
            'token' => $token,
        ], 200);
    }

    public function decoder()
    {
        return JWT::decode($this->token, $this->key, $this->cipher);
    }
}
