<?php

namespace App\Http\Controllers;

use App\Helpers\Allocator;
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
        $this->files = new Allocator($request);
        $this->tokenizer = new Token($request);
    }

    public function register()
    {
        $users = new User;

        $users->name = $this->user;
        $users->email = $this->mail;
        $users->password = encrypt($this->pass);
        $users->save();

        $this->files->csvInspector();

        return $this->tokenizer->encoder($users->email);
    }

    public function login()
    {
        $data = ['email' => $this->mail];

        $user = User::where($data)->first();

        $basePass = decrypt($user->password);

        if ($this->pass == $basePass)
        {
            $this->files->csvInspector();

            return $this->tokenizer->encoder($this->mail);
        }
    }
}
