<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

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
     * @return Response
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
     * @return Response
     */
    public function show(Order $order)
    {
        return OrderResource::make($order->load('items', 'items.product'));
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
}
