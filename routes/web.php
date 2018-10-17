<?php

// EPSON: https://files.support.epson.com/pdf/pos/bulk/tm-int_sdp_um_e_reve.pdf
// STAR: file:///Users/badchoice/Downloads/IFBD-HI01X_CloudPRNT_for_Developer_Rev14.pdf
Route::get('/', function () {
    return view('welcome');
});

Route::post('printJobs', 'PrintJobController@store');

Route::post('epson/printJobs', 'EpsonPrintJobController@index');

Route::post('star/printJobs', 'StarPrintJobController@index');
Route::get('star/printJobs', 'StarPrintJobController@show');
Route::delete('star/printJobs', 'StarPrintJobController@delete');
