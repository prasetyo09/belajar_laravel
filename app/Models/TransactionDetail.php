<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'order_qty',
        'order_price',
        'order_subtotal'
    ];
}
