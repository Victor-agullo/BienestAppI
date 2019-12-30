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
        $this->request  = $request;
    }

    public function index()
    {

    }

    public function store()
    {
        $app = new Application;
        $app->storeFromUser($this->request);

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
