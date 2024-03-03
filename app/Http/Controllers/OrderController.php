<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\LastDeliveryResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use App\Services\Order\Checkout;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
}
