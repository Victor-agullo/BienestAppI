<?php

namespace App\Helpers;

use App\Application;
use App\User;
use Symfony\Component\HttpFoundation\Request;

class Identifier
{
    function __construct(Request $request)
    {
        $this->email = $request->email;
    }

    public function idUserGetter()
    {
        $data = ['email' => $this->email];

        $id_user = User::where($data)->first();

        return $id_user->id;
    }

    public function idAppsGetter()
    {
        $id_user = $this->idUserGetter();

        $data = ['id_user' => $id_user];

        $id_app = Application::where($data)->get('id');

        return $id_app;
    }
}
