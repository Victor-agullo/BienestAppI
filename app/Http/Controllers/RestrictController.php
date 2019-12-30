<?php

namespace App\Http\Controllers;

use App\Restrict;
use Illuminate\Http\Request;

class RestrictController extends Controller
{
    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        //
    }

    public function store()
    {
        $restriction = new Restrict;
        $restriction->addRestriction($this->request);
    }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function update()
    {
    }
}
