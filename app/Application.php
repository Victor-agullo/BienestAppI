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
        $path = Storage::url("$value.png");
        $apps->icon = asset($path);
        $apps->save();
    }

    public function storeFromUser(Request $request)
    {
        $apps = new Application;
        $apps->name = $request->name;
        $path = Storage::url("$request->name.png");
        $apps->icon = asset($path);
        $apps->save();
    }
}
