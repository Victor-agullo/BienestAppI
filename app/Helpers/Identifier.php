<?php

namespace App\Helpers;

use App\Helpers\Token;
use App\Application;
use App\User;
use Symfony\Component\HttpFoundation\Request;

class Identifier
{
    function __construct(Request $request)
    {
        $this->request = $request;
        $this->email = $request->email;
    }

    public function idUserGetter()
    {
        if ($this->email==NULL) {
            $tokenizer = new Token($this->request);
            $decoded = $tokenizer->decoder();
            $this->email = $decoded;
        }
        $data = ['email' => $this->email];

        $id_user = User::where($data)->first();

        return $id_user->id;
    }

    public function idAppGetter($appName)
    {
        $data = ['name' => $appName];

        $id_app = Application::where($data)->first();

        return $id_app->id;
    }

    public function fullID()
    {
        $id_user = $this->idUserGetter();
        $appName = $this->request->app;
        $id_app = $this->idAppGetter($appName);

        $data = [
            'id_user' => $id_user,
            'id_app' => $id_app,
        ];

        return $data;
    }
}
