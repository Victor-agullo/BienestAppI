<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    function __construct(Request $request)
    {
        $this->user  = $request->name;
        $this->mail = $request->email;
        $this->pass = $request->password;
        $this->request = $request;
    }

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
}
