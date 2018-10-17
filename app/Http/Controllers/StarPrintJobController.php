<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StarPrintJobController extends Controller
{
    public function index()
    {
        Log::info("STAR index called");
        return response()->json([
            "jobReady" => true,
            "mediaTypes" => [
                "text/plain",
                //"image/png"
            ]
        ]);
    }

    public function show()
    {
        Log::info("STAR Show called");
        return response()->make('Hello baby\How Are you');
    }

    public function delete(){
        Log::info("STAR delete called");
    }
}
