<?php

namespace App\Helpers;

use App\Usage;
use Symfony\Component\HttpFoundation\Request;

class Allocator
{
    function __construct(Request $request)
    {
        $this->email = $request->email;
        $this->cardtridge = $request->csvFile;
        $this->usage = new Usage;
    }

    public function csvInspector()
    {
        if ($file = fopen($this->cardtridge, 'r')) {
            fgetcsv($file);

            while ($values = fgetcsv($file, ",")) {
                $columns = count($values);

                for ($i = 0; $i < $columns; $i++) {
                    $this->trimData($i, $values);
                }
            }
            fclose($file);
        }
    }

    public function trimData($i, $values)
    {
        $timeArray = [];
        $locationArray = [];

        switch ($values[$i]) {
            case $values[2]:
                $formattedTime = strtotime($values[0]);

                $timeArray[] = $formattedTime;

                $this->seizeData($timeArray);

                $locationArray[] = $values[3];

                $locationArray[] = $values[4];

                $this->seizeData($locationArray);
                break;
        }
    }

    public function seizeData($dataArray)
    {
        //Prueba con un while, yo qué sé
        for ($i = 0; $i < count($dataArray);) {
            $j = $i + 1;
            
            if (is_int($dataArray[0])) {
                $totalTime = $dataArray[$j] - $dataArray[$i];

                $timeArray[] = $totalTime;

                var_dump($timeArray[$i]);
                //$this->usage->Time = $dataDiff;
                //$this->usage->save();
            } else {
                $dataArray[$j];
                $dataArray[$i];
            }
            $i + 2;
        }
    }
}
