<?php

namespace App\Http\Controllers;

use App\PrintJob;

class PrintJobController extends Controller
{
    public function store($printerIdentifier = null)
    {
        $printJob = PrintJob::create([
            "uuid" => $printerIdentifier ?? request('uuid'),
            "job" => request('job')
        ]);
        return response(["id" => $printJob->id]);
    }
}
