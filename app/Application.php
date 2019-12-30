<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Application extends Model
{
    public function storeFromCSV($value)
    {
        $apps = new Application;

        $apps->name = $value;
        //No me convence ABSOLUTAMENTE NADA la siguiente línea:
        $apps->icon = Storage::url("$value.png");
        $apps->save();
    }

    public function storeFromUser(Request $request)
    {
        $apps = new Application;
        $apps->name = $request->name;
        $apps->icon = Storage::url("$request->name.png");
        $apps->save();
    }
}
