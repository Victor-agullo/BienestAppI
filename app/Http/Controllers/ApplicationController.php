<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Http\Request;
use App\Helpers\Identifier;
use App\Helpers\Gallery;

class ApplicationController extends Controller
{
    function __construct(Request $request)
    {
        $this->name  = $request->name;
        $this->identifier = new Identifier($this->request);
        $this->gallery = new Gallery($this->request);
    }

    public function index()
    {

    }

    public function store()
    {
        $app = new Application();

        $id_user = $this->identifier->idUserGetter();
        $icon = $this->gallery->iconGetter();

        $app->user_id = $id_user;
        $app->name = $this->name;
        $app->icon = $icon;
        $app->save();

        return response()->json([
            'message' => 'App incluida satisfactoriamente.',
        ], 200);
    }

    public function show()
    {
        //
    }

    public function destroy()
    {
        //
    }

    public function update()
    {
        //
    }
}
