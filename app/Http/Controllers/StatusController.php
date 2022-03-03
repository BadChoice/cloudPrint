<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;

class StatusController extends Controller
{
    public function get($printerIdentifier = null)
    {
        $id = $printerIdentifier ?? request('uuid');
        $date = Redis::lpop("CloudPrinter_".$id);
        if (!$date) {
            return response([$id => "OFFLINE"]);
        }

        $date = Carbon::createFromFormat('Y-m-d H:i:s',$date);
        $seconds = $date->diffInSeconds(Carbon::now());

        return response([$id => ($seconds < 20 ? "ONLINE" : "OFFLINE")]);
    }
}
