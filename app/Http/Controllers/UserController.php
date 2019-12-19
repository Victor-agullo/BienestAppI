<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Token;
use App\User;

class UserController extends Controller
{
    function __construct(Request $request)
    {
        $this->user  = $request->name;
        $this->mail = $request->email;
        $this->pass = $request->password;
        $this->request = $request;
    }

    public function register()
    {
        $users = new User;
        $users->name = $this->user;
        $users->email = $this->mail;
        $users->password = encrypt($this->pass);
        $users->save();

        $tokenizer = new Token($this->request);
        return $tokenizer->encoder($users->email);
    }

    public function login()
    {
        $data = ['email' => $this->mail];

        $user = User::where($data)->first();

        if ($this->pass == decrypt($user->password)) {
            $login = new Token($this->request);
            return $login->encoder($this->mail);
        }
    }
}
