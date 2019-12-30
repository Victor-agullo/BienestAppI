<?php

namespace App;

use App\Helpers\Identifier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Usage extends Model
{
    public function store(Request $request, $appName, $totalTime, $formattedTime)
    {
        $usages = new Usage;

        $user_id = new Identifier($request);
        $usages->ID_USER = $user_id->idUserGetter();

        $id_app = Application::where('name', $appName)->first();
        $usages->ID_APP = $id_app->id;

        $finaltime = Date("H:i:s", $totalTime);
        $usages->Time = $finaltime;

        $dates = date('Y-m-d H:i:s', $formattedTime);
        $usages->Date = $dates;
        
        $usages->save();
    }
}
