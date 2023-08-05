<?php

namespace App\Http\Controllers;

use App\Http\Requests\Delivery\StoreDeliveryRequest;
use App\Http\Requests\Delivery\UpdateDeliveryRequest;
use App\Http\Resources\DeliveryResource;
use App\Models\Delivery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return DeliveryResource::collection(Delivery::with('boxes')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDeliveryRequest $request
     * @return Response
     */
    public function store(StoreDeliveryRequest $request)
    {
        $delivery = Delivery::create($request->all());

        $delivery = $delivery->fresh();

        return DeliveryResource::make($delivery->load('boxes'));
    }

    /**
     * Display the specified resource.
     *
     * @param Delivery $delivery
     * @return Response
     */
    public function show(Delivery $delivery)
    {
        return DeliveryResource::make($delivery->load('boxes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDeliveryRequest $request
     * @param Delivery $delivery
     * @return Response
     */
    public function update(UpdateDeliveryRequest $request, Delivery $delivery)
    {
        $delivery->update($request->all());

        return DeliveryResource::make($delivery->load('boxes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Delivery $delivery
     * @return JsonResponse
     */
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();

        return response()->json(null, 204);
    }
}
