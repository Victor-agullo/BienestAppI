<?php

namespace App\Http\Controllers;

use App\Application;
use App\Helpers\Identifier;
use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    function __construct(Request $request)
    {
        $this->request = $request;
        $this->identify = new Identifier($request);
    }

    public function trace()
    {
        $id_user = $this->identify->idUserGetter();

        $rows = Application::count('id') + 1;

        for ($i = 1; $i < $rows; $i++) {
            $data = [
                'id_user' => $id_user,
                'id_app' => $i
            ];

            $lastPlace = Location::where( $data )->latest('id')->first();

            $organisedArray[] = [
                'latitude' => $lastPlace->latitude,
                'longitude' => $lastPlace->longitude];
    }
        return response()->json($organisedArray, 200);
    }
}
