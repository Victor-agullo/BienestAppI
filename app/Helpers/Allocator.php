<?php

namespace App\Helpers;

use App\Application;
use App\Store;
use App\Usage;
use Symfony\Component\HttpFoundation\Request;

class Allocator
{
    function __construct(Request $request)
    {
        $this->request = $request;
        $this->cardtridge = $request->csvFile;
        $this->apps = new Application;
        $this->usages = new Usage;
        $this->places = new Store;
    }

    public function csvInspector()
    {
        if ($file = fopen($this->cardtridge, 'r')) {
            fgetcsv($file);

            while ($values = fgetcsv($file, ",")) {

                $formattedTime[] = strtotime($values[0]);
                $appName[] = $values[1];
                $latitudeArray[] = $values[3];
                $longitudeArray[] = $values[4];
            }
        }
        $this->existencyCheck($formattedTime, $appName, $latitudeArray, $longitudeArray);
    }

    public function existencyCheck($formattedTime, $appName, $latitudeArray, $longitudeArray)
    {
        $rows = count($formattedTime) - 1;

        for ($i = 0; $i < $rows; $i++) {
            $i++;
            $data = [
                'date' => Date("Y-m-d H:i:s", $formattedTime[$i]),
            ];

            if (!Usage::where($data)->first()) {
                $this->appRegistry($appName, $i);
                $i--;
                $this->dataProcess($formattedTime, $appName, $i);
                $this->seizeData($latitudeArray, $longitudeArray, $appName, $i);
                $i++;
            }
        }
    }

    public function appRegistry($appName, $i)
    {
        if (!Application::where("name", $appName[$i])->first()) {
            $this->apps->storeFromCSV($appName[$i]);
        }
    }

    public function dataProcess($formattedTime, $appName, $i)
    {
        $opens = $formattedTime[$i];
        $i++;
        $closes = $formattedTime[$i];
        $totalTime = $closes - $opens;

        $this->usages->store($this->request, $appName[$i], $totalTime, $formattedTime[$i]);
    }

    public function seizeData($latitudeArray, $longitudeArray, $appName, $i)
    {
        $this->places->savingPlaces($this->request, $latitudeArray[$i], $longitudeArray[$i], $appName[$i]);
    }
}
