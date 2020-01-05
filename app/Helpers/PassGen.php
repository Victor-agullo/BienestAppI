<?php

namespace App\Helpers;

use App\User;
use Illuminate\Http\Request;

class PassGen
{
    public function __construct(Request $request)
    {
        $this->email = $request->email;
    }

    public function passGenerator()
    {
        $passBody = substr(sha1(microtime()), 1, 4);
        $password = "(¿$passBody.)";

        $this->passSubstitution($password);

        return $password;
    }

    public function passSubstitution($password)
    {
        $data = ['email' => $this->email];

        User::where($data)
            ->update(['password' => encrypt($password)]);
    }
}
