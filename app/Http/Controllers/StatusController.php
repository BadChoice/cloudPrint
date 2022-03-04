<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;

class StatusController extends Controller
{
    public function get($printerIdentifier = null)
    {
        $id = $printerIdentifier ?? request('uuid');
        try {
            $date = Redis::get("CloudPrinter_".$id);
            if (!$date) { throw new \Exception("Key not found."); }

            $date = Carbon::createFromFormat('Y-m-d H:i:s',$date);
            $seconds = $date->diffInSeconds(Carbon::now());

            return response(["id" => $id, "status" => ($seconds < 20 ? "ONLINE" : "OFFLINE")]);
        } catch (\Exception $e) {
            return response(["id" => $id, "status" => "OFFLINE"]);
        }
    }
}
