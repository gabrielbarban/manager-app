<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Trade;

class TradingBotController extends Controller
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('BRASILBITCOIN_API_KEY');
    }

    public function runBot()
    {
        \Log::info("CRONTAB SENDO EXECUTADO");

        $symbol = 'BTC';
        $price = $this->getBitcoinPrice($symbol);

        $activeTrade = Trade::where('status', 'aguardando_venda')->first();

        if ($activeTrade) {
            $currentPrice = $price;
            $targetPrice = $activeTrade->buy_price * 1.005;
            \Log::info("currentPrice: ".$currentPrice);
            \Log::info("buy_price: ".$activeTrade->buy_price);
            \Log::info("targetPrice: ".$targetPrice);
            \Log::info("\n\n");
            if ($currentPrice >= $targetPrice) {
                $this->sellBitcoin($activeTrade->amount_crypto);
                $activeTrade->update(['status' => 'vendido']);
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
            \Log::error('Erro na compra de Bitcoin', [
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
            'order_type' => 'market',
            'amount' => round($btcAmount, 8),
            'price' => 1
        ]);

        if (!$response->successful()) {
            \Log::error('Erro na venda de Bitcoin', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            throw new \Exception('Erro ao vender Bitcoin.');
        }

        return $response->json();
    }
}
