<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintJob extends Model
{
    const STATUS_PENDING    = 0;
    const STATUS_PRINTED    = 1;
    const STATUS_ERROR      = 2;

    protected $guarded = [];
}
