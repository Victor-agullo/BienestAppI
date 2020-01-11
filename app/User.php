<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class User extends Model
{
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = encrypt($request->password);
        $user->save();
    }

    public function applications()
    {
        return $this->hasManyThrough(
            'App\Application',
            'App\Location',
            'App\Restrict', 
            'App\Usage');
    }
}
