<?php

namespace App;

use App\Helpers\Identifier;
use DateTime;
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
            $dayTime = $this->timeConverter($value->time);
            $sum += $dayTime;
        }

        $days = count($times);
        $dayAvg = $sum / $days;
        $weekAvg = $sum / 7;
        $monthAvg = $sum / 30;

        $total = date("H:i:s", $sum);
        $dayAvgFormatted = date("H:i:s", $dayAvg);
        $weekAvgFormatted = date("H:i:s", $weekAvg);
        $monthAvgFormatted = date("H:i:s", $monthAvg);

        return [
            'total' => $total,
            'medio diario' => $dayAvgFormatted,
            'medio semanal' => $weekAvgFormatted,
            'medio mensual' => $monthAvgFormatted,
        ];
    }

    public function timeConverter($time)
    {
        list($hours, $minutes, $seconds) = explode(":", $time);
        $minutes += $hours * 60;
        $seconds += $minutes * 60;
        return $seconds;
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
