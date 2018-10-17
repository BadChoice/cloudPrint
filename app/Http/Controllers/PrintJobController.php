<?php

namespace App\Http\Controllers;

use App\PrintJob;

class PrintJobController extends Controller
{
    public function store()
    {
        $printJob = PrintJob::create([
            "uuid" => request('uuid'),
            "job" => request('job')
        ]);
        return response(["id" => $printJob->id]);
    }
}
