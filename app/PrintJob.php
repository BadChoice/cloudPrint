<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintJob extends Model
{
    const STATUS_PENDING    = 0;
    const STATUS_PRINTING   = 1;
    const STATUS_PRINTED    = 2;
    const STATUS_ERROR      = 3;

    protected $guarded = [];

    public function scopePending($query)
    {
        return $query->where('status', PrintJob::STATUS_PENDING);
    }

    public function scopePrinting($query)
    {
        return $query->where('status', PrintJob::STATUS_PRINTING);
    }
}
