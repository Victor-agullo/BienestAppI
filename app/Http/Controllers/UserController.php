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
        $this->request = $request;
        $this->files = new Allocator($request);
        $this->tokenizer = new Token($request);
    }

    public function register()
    {
        $users = new User;

        $users->store($this->request);

        $this->files->csvInspector();

        return $this->tokenizer->encoder($users->email);
    }

    public function login()
    {
        $data = ['email' => $this->request->email];

        $user = User::where($data)->first();

        $basePass = decrypt($user->password);

        if ($this->request->password == $basePass)
        {
            $this->files->csvInspector();

            return $this->tokenizer->encoder($this->request->email);
        }
    }
}
