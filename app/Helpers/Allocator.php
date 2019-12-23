<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\Request;

class Allocator
{
    function __construct(Request $request)
    {
        $this->email = $request->email;
        $this->cardtridge = $request->csvFile;
    }

    public function seizeData()
    {
        $file = fopen($this->cardtridge,'r');
        $data = fgetcsv($file,36, ",", "\n");
        $num = count($data);

        if ($file !== FALSE)
        {
            while ($data !== FALSE)
            {
                $data;
            }
            var_dump($data[0]);
            exit;
            fclose($file);
        }
    }
}