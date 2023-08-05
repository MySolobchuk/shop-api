<?php

namespace App\Http\Controllers;

use App\Http\Requests\Box\StoreBoxRequest;
use App\Http\Requests\Box\UpdateBoxRequest;
use App\Http\Resources\BoxResource;
use App\Models\Box;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return BoxResource::collection(Box::with('delivery')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBoxRequest $request
     * @return Response
     */
    public function store(StoreBoxRequest $request)
    {
        $box = Box::create($request->all());

        $box = $box->fresh();

        return BoxResource::make($box->load('delivery'));
    }

    /**
     * Display the specified resource.
     *
     * @param Box $box
     * @return Response
     */
    public function show(Box $box)
    {
        return BoxResource::make($box->load('delivery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBoxRequest $request
     * @param Box $box
     * @return Response
     */
    public function update(UpdateBoxRequest $request, Box $box)
    {
        $box->update($request->all());

        return BoxResource::make($box->load('delivery'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Box $box
     * @return JsonResponse
     */
    public function destroy(Box $box)
    {
        $box->delete();

        return response()->json(null, 204);
    }
}
