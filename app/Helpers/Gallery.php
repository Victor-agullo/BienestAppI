<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\Request;

class Gallery
{
    function __construct(Request $request)
    {
        $this->name = $request->name;
    }

    public function iconGetter()
    {
        $file = glob("images/$this->name.png");

        return $file;
    }

}
