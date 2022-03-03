<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;

class StatusController extends Controller
{
    public function get($printerIdentifier = null)
    {
        $id = $printerIdentifier ?? request('uuid');
        $date = Redis::lpop("CloudPrinter_".$id);
        return response(["lastSeen" => $date]);
    }
}
