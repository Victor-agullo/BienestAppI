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
        $rows = 0;

        if ($file = fopen($this->cardtridge, 'r'))
        {
            while ($values = fgetcsv($file, ","))
            {
                $columns = count($values);

                for ($i = 0; $i < $columns; $i++)
                {
                    echo $values[$i] . "\n";
                }
            }
        }
    }
}
