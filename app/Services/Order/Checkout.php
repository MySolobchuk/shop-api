<?php

namespace App\Services\Order;

use App\Models\Order;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Checkout
{
    public function __construct()
    {
    }

    public function checkout(Order $order): Response
    {
        DB::beginTransaction();
        try {
            $order->startCheckout();
            $order->save();
            $sign = hash(
                'sha384',
                json_encode([
                    'sessionId' => (string)$order->id,
                    'merchantId' => 259640,
                    'amount' => $order->getPrice() * 100,
                    "currency" => "PLN",
                    'crc' => 'f68aa7d7522f2307',
                ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            );
            $response = Http::withBasicAuth(
                '259640',
                '7f704442a9563c9aed97111fa45b8329'
            )->post('https://sandbox.przelewy24.pl/api/v1/transaction/register', [
                "merchantId" => 259640,
                "posId" => 259640,
                "sessionId" => (string)$order->id,
                "amount" => $order->getPrice() * 100,
                "currency" => "PLN",
                "description" => "Purchase id $order->id",
                "email" => $order->user_information['email'],
                "client" => "string",
                "country" => "PL",
                "phone" => "string",
                "language" => "pl",
                "method" => 0,
                "urlReturn" => "https://polandgroups.pl/shop",
                "urlStatus" => "https://shop-api.polandgroups.pl/api/order",
                "channel" => 12294,
                "shipping" => $order->getBoxPrice() * 100,
                "sign" => $sign,
            ]);

            DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }

        return $response;
    }
}
