<?php

namespace App\Http\Controllers;

use App\Services\TradeService;
use Illuminate\Support\Facades\DB;

class TradesController extends Controller
{
    protected $tradeService;

    public function __construct(TradeService $tradeService)
    {
        $this->tradeService = $tradeService;
    }

    public function index()
    {
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if (empty($logged) || $logged === 0 || $logged === '0') {
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }

        $trades = $this->tradeService->listTrades();

        $btcPrice = DB::table('prices')->orderByDesc('id')->value('price');

        $todayProfit = DB::table('trades')
            ->whereDate('updated_at', now()->toDateString())
            ->where('status', 'vendido')
            ->sum('profit_brl');

        $monthProfit = DB::table('trades')
            ->whereMonth('updated_at', now()->month)
            ->whereYear('updated_at', now()->year)
            ->where('status', 'vendido')
            ->sum('profit_brl');

        $todayProfitNet = $todayProfit - ($todayProfit * 0.005);
        $monthProfitNet = $monthProfit - ($monthProfit * 0.005);

        $todayTradesCount = DB::table('trades')
            ->whereDate('updated_at', now()->toDateString())
            ->where('status', 'vendido')
            ->count();

        $monthTradesCount = DB::table('trades')
            ->whereMonth('updated_at', now()->month)
            ->whereYear('updated_at', now()->year)
            ->where('status', 'vendido')
            ->count();

        $todayAvgProfit = $todayTradesCount ? $todayProfit / $todayTradesCount : 0;
        $monthAvgProfit = $monthTradesCount ? $monthProfit / $monthTradesCount : 0;

        $btcHistory = DB::table('prices')
            ->where('created_at', '>=', now()->subHours(24))
            ->orderBy('created_at')
            ->get(['created_at', 'price']);

        return view('templatemo-js.trades', [
            'trades' => $trades,
            'btcPrice' => $btcPrice,
            'todayProfit' => $todayProfit,
            'monthProfit' => $monthProfit,
            'todayProfitNet' => $todayProfitNet,
            'monthProfitNet' => $monthProfitNet,
            'btcHistory' => $btcHistory,
            'todayTradesCount' => $todayTradesCount,
            'monthTradesCount' => $monthTradesCount,
            'todayAvgProfit' => $todayAvgProfit,
            'monthAvgProfit' => $monthAvgProfit
        ]);
    }
}
