<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Trade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TradingBotController extends Controller
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('BRASILBITCOIN_API_KEY');
    }

    public function runBot()
    {
        Log::info("CRONTAB SENDO EXECUTADO");

        $symbol = 'BTC';
        $price = $this->getBitcoinPrice($symbol);

        $lastPrice = DB::table('prices')->orderByDesc('id')->first();
        if (!$lastPrice || floatval($lastPrice->price) !== floatval($price)) {
            DB::table('prices')->insert([
                'price' => $price,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $activeTrade = Trade::where('status', 'aguardando_venda')->first();

        if ($activeTrade) {
            $currentPrice = $price;
            $targetPrice = $activeTrade->buy_price * 1.00007;
            Log::info("currentPrice: ".$currentPrice);
            Log::info("targetPrice: ".$targetPrice);
            Log::info("\n\n");
            if ($currentPrice >= $targetPrice) {
                $sell_price = $this->sellBitcoin($activeTrade->amount_crypto);
                $profit = $activeTrade->amount_crypto * ($sell_price - $activeTrade->buy_price);

                $activeTrade->status = 'vendido';
                $activeTrade->profit_brl = round($profit, 2);

                $activeTrade->save();
                Log::info('profit_brl:');
                Log::info($activeTrade->profit_brl);
                Log::info('sell_price:');
                Log::info($sell_price);
                return response()->json(['message' => 'Venda realizada com lucro.']);
            }

            return response()->json(['message' => 'AGUARDANDO VALORIZACAO.']);
        } else {
            $this->buyBitcoin(10);
            return response()->json(['message' => 'Compra realizada.']);
        }
    }

    private function getBitcoinPrice($symbol)
    {
        $url = "https://brasilbitcoin.com.br/API/prices/{$symbol}";
        $response = Http::get($url);

        if ($response->successful()) {
            return floatval($response->json()['buy']);
        }

        throw new \Exception('Erro ao consultar preço do Bitcoin.');
    }

    private function buyBitcoin($valueInBRL)
    {
        $price = $this->getBitcoinPrice('BTC');

        $averageLast10Min = DB::table('prices')
            ->where('created_at', '>=', now()->subMinutes(50))
            ->avg('price');

        if ($averageLast10Min && $price > ($averageLast10Min * 1.007)) {
            Log::info('averageLast10Min:');
            Log::info($averageLast10Min);
            Log::info('price:');
            Log::info($price);
            Log::info('Compra abortada. Preço atual muito acima da média dos últimos 50 minutos.');
            return response()->json(['message' => 'Preço atual acima da média. Aguardando desvalorização para comprar.']);
        }

        $btcAmount = $valueInBRL / $price;

        $url = 'https://brasilbitcoin.com.br/api/create_order';

        $response = Http::withHeaders([
            'Authentication' => $this->apiKey,
            'Content-Type' => 'application/json'
        ])->post($url, [
            'coin_pair' => 'BRLBTC',
            'type' => 'buy',
            'order_type' => 'market',
            'amount' => round($valueInBRL, 2),
            'price' => 1
        ]);

        if (!$response->successful()) {
            Log::error('Erro na compra de Bitcoin', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            throw new \Exception('Erro ao comprar Bitcoin.');
        }

        Trade::create([
            'symbol' => 'BTC',
            'amount_brl' => $valueInBRL,
            'amount_crypto' => round($btcAmount, 8),
            'buy_price' => round($price, 2),
            'status' => 'aguardando_venda'
        ]);

        return $response->json();
    }

    private function sellBitcoin($btcAmount)
    {
        $url = 'https://brasilbitcoin.com.br/api/create_order';
        $price = $this->getBitcoinPrice('BTC');

        $response = Http::withHeaders([
            'Authentication' => $this->apiKey,
            'Content-Type' => 'application/json'
        ])->post($url, [
            'coin_pair' => 'BRLBTC',
            'type' => 'sell',
            'order_type' => 'limited',
            'amount' => $btcAmount,
            'price' => $price
        ]);

        if (!$response->successful()) {
            Log::error('Erro na venda de Bitcoin', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            Log::info($btcAmount);
            throw new \Exception('Erro ao vender Bitcoin.');
        }

        return $price;
    }
}
