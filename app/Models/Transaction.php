<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'order_code',
        'order_amount',
        'order_change',
        'order_status'
    ];
}
