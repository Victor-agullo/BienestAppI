<?php

namespace App\Http\Controllers;

use App\Application;
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
        $id_user = $this->identify->idUserGetter();

        $array = Application::select('icon', 'name')
            ->get();

        $rows = count($array);
        for ($i = 0; $i < $rows; $i++) {
            $data = [
                'id_user' => $id_user,
                'id_app' => $rows
            ];

            $total = $this->use->totalTime($data);
            $daily = $this->use->dailyTime($data);

            $pack[$i] = [
                $array[$i],
                $total,
                $daily
            ];
        }

        return response()->json([
            $pack
        ], 200);
    }
}
