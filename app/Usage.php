<?php

namespace App;

use App\Helpers\Identifier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Usage extends Model
{
    public function store(Request $request, $appName, $totalTime, $formattedTime)
    {
        $usages = new Usage;

        $user_id = new Identifier($request);
        $usages->ID_USER = $user_id->idUserGetter();

        $id_app = Application::where('name', $appName)->first();
        $usages->ID_APP = $id_app->id;

        $finaltime = Date("H:i:s", $totalTime);
        $usages->Time = $finaltime;

        $dates = date('Y-m-d H:i:s', $formattedTime);
        $usages->Date = $dates;

        $usages->save();
    }

    public function totalTime($data)
    {
        $times = Usage::where($data)
            ->select('time')
            ->get();
        $sum = 0;

        foreach ($times as $key => $value) {
            $sum += strtotime($value->time);
        }

        $total = Date("H:i:s", $sum);
        $dailyAverage = $this->dayAvg($times);
        $weeklyAverage = $this->weekAvg($times);
        $monthlyAverage = $this->monthAvg($times);

        $total = Date("H:i:s", $sum);
        $average = Date("H:i:s", $sum / count($times));

        return [
            'total' => $total,
            'medio total' => $average,
        ];
        /*
        return [
            'total' => $total,
            'medio diario' => $dailyAverage,
            'medio semanal' => $weeklyAverage,
            'medio mensual' => $monthlyAverage
        ];
        */
    }

    public function dayAvg($times)
    {
        foreach ($times as $key => $value) {
            $day = Date("d", strtotime($value->time));

            if ($day) {
                # code...
            }
        }
    }

    public function weekAvg($times)
    {
        foreach ($times as $key => $value) {
            $month = Date("m", strtotime($value->time));

            if ($month) {
                # code...
            }
        }
    }

    public function monthAvg($times)
    {
        foreach ($times as $key => $value) {
            $year = Date("Y", strtotime($value->time));

            if ($year) {
                # code...
            }
        }
    }

    public function dailyTime($data)
    {
        $times = Usage::where($data)
            ->select('time', 'date')
            ->latest('date')
            ->get();

        $num = [];

        foreach ($times as $key => $value) {
            $day = Date('Y-m-d', strtotime($value->date));

            if (!in_array($day, $num)) {
                $num[] = $day;
                $keeper = $day;
                $timeSum = 0;
            }
            $timeSum += strtotime($value->time);
            $diary[$keeper] =  Date("H:i:s", $timeSum);
        }
        return $diary;
    }
}
