<?php

namespace App\Http\Controllers;

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
        $data = $this->identify->fullID();
        $lastPlace = Location::where($data)->latest()->first();
        return response()->json([
            'latitude' => $lastPlace->latitude,
            'longitude' => $lastPlace->longitude,
        ], 200);
    }
}
