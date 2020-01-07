<?php

namespace App;

use App\Helpers\Identifier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Location extends Model
{
    public function savingPlaces(Request $request, $latitude, $longitude, $appName)
    {
        $places = new Location;
        $user_id = new Identifier($request);
        $places->ID_USER = $user_id->idUserGetter();
    
        $id_app = Application::where('name', $appName)->first();
        $places->ID_APP = $id_app->id;

        $places->longitude = $longitude;
        $places->latitude = $latitude;

        $places->save();
    }
}
