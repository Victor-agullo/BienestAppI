<?php

namespace App;

use App\Helpers\Identifier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Store extends Model
{
    public function savingPlaces(Request $request, $latitude, $longitude, $appName)
    {
        $places = new Store;
        $user_id = new Identifier($request);
        $places->ID_USER = $user_id->idUserGetter();
    
        $id_app = Application::where('name', $appName)->first();
        $places->ID_APP = $id_app->id;

        $places->longitude = $longitude;
        $places->latitude = $latitude;

        $places->save();
    }
}
