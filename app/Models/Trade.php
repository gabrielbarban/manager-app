<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $fillable = [
        'symbol',
        'amount_brl',
        'amount_crypto',
        'buy_price',
        'status',
    ];
}
