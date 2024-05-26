<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\LastDeliveryResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Mail\OrderVerified;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use App\Services\Order\Checkout;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return OrderResource::collection(Order::with('items', 'items.product')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderRequest $request
     * @return OrderResource
     */
    public function store(StoreOrderRequest $request)
    {
        $order = new Order($request->except('items'));

        $order->save();

        $order->items()->createMany($request->items);
        $order->save();

        return OrderResource::make($order->load('items', 'items.product'));
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return OrderResource
     */
    public function show(Order $order)
    {
        return OrderResource::make($order->load('items', 'items.product'));
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return \Illuminate\Http\Client\Response
     */
    public function checkout(Order $order, Checkout $checkout)
    {
        return $checkout->checkout($order);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderRequest $request
     * @param Order $order
     * @return Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return \response()->json(null, 204);
    }

    public function lastDelivery(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $order = $user->orders()->latest()->first();

        return LastDeliveryResource::make($order);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     */
    public function verify(Order $order, Request $request)
    {
        DB::beginTransaction();
        try {
            $order->verify($request->get('orderId'));
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
            )->put('https://sandbox.przelewy24.pl/api/v1/transaction/verify', [
                "merchantId" => 259640,
                "posId" => 259640,
                "sessionId" => (string)$order->id,
                "amount" => $order->getPrice() * 100,
                "currency" => "PLN",
                'orderId' => $request->get('orderId'),
                "sign" => $sign,
            ]);

            if ($response->successful()) {
                $order->save();
                try {
                Mail::to([$order->user_information['email'], 'polandgroups5@gmail.com'])->send(new OrderVerified($order));
                } catch (\Throwable $e) {
                    Log::error('Error sending email: ' . $e->getMessage(), [
                        'error' => $e,
                        'traceAsString' => $e->getTraceAsString(),
                        'trace' => $e->getTrace(),
                        'request' => $request->all(),
                    ]);
                }
                DB::commit();
            } else {
                $order->fresh();
                Log::warning($response->json(),
                    [
                        'order' => $order,
                        'request' => $request->all(),
                    ]);
                DB::rollBack();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage(), [
                'error' => $e,
                'trace' => $e->getTraceAsString(),
            ]);
            DB::rollBack();

            throw $e;
        }
    }
}
