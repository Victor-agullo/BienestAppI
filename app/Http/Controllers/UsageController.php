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
    }

    public function index()
    {
        //
    }

    public function store()
    {
        //
    }

    public function times()
    {
        $id_user = $this->identify->idUserGetter();
        $appName = $this->request->app;
        $id_app = $this->identify->idAppGetter($appName);

        $data = [
            'id_user' => $id_user,
            'id_app' => $id_app,
        ];

        $times = Usage::where($data)->get();

        $total = $this->totalTime($times);

        return response()->json([
            'tiempo total' => $total,
            'tiempo diario' => '',
            'tiempo medio' => '$average',
        ], 200);
    }

    public function totalTime($times)
    {
        $sum = 0;

        foreach ($times as $key => $value) {
            $sum += strtotime($value->time);
        }

        return Date("H:i:s", $sum);
    }

    public function destroy($id)
    {
    }

    public function update(Request $request, $id)
    {
    }
}
