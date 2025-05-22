<?php

namespace App\Services;

use App\Repositories\TradesRepository;

class TradeService
{
    protected $tradesRepository;

    public function __construct(TradesRepository $tradesRepository)
    {
        $this->tradesRepository = $tradesRepository;
    }

    public function listTrades()
    {
        return $this->tradesRepository->listTrades();
    }
}
