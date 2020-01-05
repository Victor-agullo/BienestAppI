<?php

namespace App\Http\Controllers;

use App\Helpers\Allocator;
use App\Helpers\PassGen;
use Illuminate\Http\Request;
use App\Helpers\Token;
use App\User;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    function __construct(Request $request)
    {
        $this->request = $request;
        $this->files = new Allocator($request);
        $this->tokenizer = new Token($request);
        $this->newPass = new PassGen($request);
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

        if ($this->request->password == $basePass) {
            $this->files->csvInspector();

            return $this->tokenizer->encoder($this->request->email);
        }
    }

    public function passRecovery()
    {
        $to_name = $this->request->name;
        $to_email = $this->request->email;

        $psswd = $this->newPass->passGenerator();
        
        $data = array('name' => $to_name, "pass" => $psswd);

        Mail::send('emails.forgot', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('Vaya, parece que has olvidado la contraseña');
            $message->from('bienestarapp@gmail.com', 'bienestarapp api server');
        });
    }
}
