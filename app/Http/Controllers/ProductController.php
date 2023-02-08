<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return ProductResource::collection(Product::with('category')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product;

        if($request->hasFile('preview')){

            $image = $request->preview;

            $ext = $image->getClientOriginalExtension();

            $filename = uniqid() . '.' . $ext;

            $image->storeAs('public/preview', $filename);

            $product->fill(['preview' => $filename]);
        }

        $product->fill($request->except('preview'));

        $product->save();

        return ProductResource::make($product->load('category'));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        dd(Storage::path('63d58a801649b.png'));

        return ProductResource::make($product->load('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());

        return ProductResource::make($product->load('category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return \response()->json(null, 204);
    }
}
