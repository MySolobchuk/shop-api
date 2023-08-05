<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\StoreFeedbackRequests;
use App\Http\Requests\Feedback\UpdateFeedbackRequests;
use App\Http\Resources\DeliveryResource;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection|Response
     */
    public function index()
    {
        return FeedbackResource::collection(Feedback::with('product')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFeedbackRequests $request
     * @return Response
     */
    public function store(StoreFeedbackRequests $request)
    {
        $feedback = Feedback::create($request->all());
        $feedback = $feedback->fresh();

        return FeedbackResource::make($feedback->load('product'));
    }

    /**
     * Display the specified resource.
     *
     * @param Feedback $feedback
     * @return Response
     */
    public function show(Feedback $feedback)
    {
        return FeedbackResource::make($feedback->load('product'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFeedbackRequests $request
     * @param Feedback $feedback
     * @return Response
     */
    public function update(UpdateFeedbackRequests $request, Feedback $feedback)
    {
        $feedback->update($request->all());

        return DeliveryResource::make($feedback->load('product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Feedback $feedback
     * @return JsonResponse
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return response()->json(null, 204);
    }
}
