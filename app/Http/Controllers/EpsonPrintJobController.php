<?php

namespace App\Http\Controllers;

use App\PrintJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class EpsonPrintJobController extends Controller
{
    public function index()
    {
        $connectionType = request('ConnectionType');
        $id             = request('ID');
        Log::info("EPSON print jobs called {$connectionType} for ID: {$id}");

        $this->savePrinterStatus($id);

        if ($connectionType == 'GetRequest') {
            return $this->returnAvailableJobs($id);
        }

        if ($connectionType == 'SetResponse') {
            return $this->setResponse($id);
        }
        return response("");
    }

    private function savePrinterStatus($printerId)
    {
        Redis::set("CloudPrinter_".$printerId, Carbon::now()->toDateTimeString());
    }

    private function returnAvailableJobs($id)
    {
        $printJobs = PrintJob::pending()->where('uuid', $id)->get();

        if ($printJobs->count() == 0 ){
            return response("");
        }

        $printJobs->each->update(["status" => PrintJob::STATUS_PRINTING]);

        $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?><PrintRequestInfo>" .
            $printJobs->pluck('job')->implode('') . "</PrintRequestInfo>";

        //$xml = file_get_contents(resource_path('samples') . '/provaJordi.xml');
//        $xml = file_get_contents(resource_path('samples') . '/sample.xml');
//        return response($xml)->withHeaders([
        return response($xml)->withHeaders([
            'Content-Type' => 'text/xml; charset=UTF-8'
        ]);
    }

    private function setResponse($id)
    {
        //TODO: Fix this with status;
        $xml = simplexml_load_string(request('ResponseFile'));
        if (count($xml->response) != 0) {
            foreach ($xml->response as $response) {
                Log::info("success : {$response['success']} code : {$response['code']}");
            }
        }
        PrintJob::printing()->where('uuid', $id)->delete();
        return response("");
    }
}
