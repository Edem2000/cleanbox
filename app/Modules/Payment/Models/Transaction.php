<?php

namespace App\Modules\Payment\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{protected $dates = [
    'canceled',
    'performed'
];

    protected $fillable = [
        'gateway_transaction_id',
        'gateway_time',
        'gateway_time_datetime',
        'amount',
        'state',
        'reason',
        'receivers',
        'order_id',
        'gateway',
        'create_time',
        'perform_time',
        'cancel_time',
        'created',
        'performed',
        'canceled'
    ];

    protected $primaryKey = 'id';

    protected $table = 'gateway_transactions';

    public $timestamps = false;

    const TIMEOUT = 43200000;

    const STATE_CREATED                  = 1;
    const STATE_COMPLETED                = 2;
    const STATE_CANCELLED                = -1;
    const STATE_CANCELLED_AFTER_COMPLETE = -2;

    const REASON_RECEIVERS_NOT_FOUND         = 1;
    const REASON_PROCESSING_EXECUTION_FAILED = 2;
    const REASON_EXECUTION_FAILED            = 3;
    const REASON_CANCELLED_BY_TIMEOUT        = 4;
    const REASON_FUND_RETURNED               = 5;
    const REASON_UNKNOWN                     = 10;

}