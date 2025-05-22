<?php

namespace App\Repositories;

use App\Models\Trade;

class TradesRepository
{
    public function listTrades()
    {
        $trades = Trade::orderBy("created_at", "DESC")->get();
        return $trades;
    }
}
