<?php

namespace App\Http\Controllers;

use App\Helpers\Identifier;
use App\Usage;
use Illuminate\Http\Request;

class UsageController extends Controller
{
    function __construct(Request $request)
    {
        $this->request = $request;
        $this->identify = new Identifier($request);
        $this->use = new Usage;
    }
    
    public function times()
    {
        $data = $this->identify->fullID();

        $total = $this->use->totalTime($data);
        $daily = $this->use->dailyTime($data);

        return response()->json([
            'tiempo' => $total,
            'tiempo en los días' => $daily,
        ], 200);
    }
}
