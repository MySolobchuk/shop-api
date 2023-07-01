<?php

namespace App\Http\Controllers;

use App\Enums\Gender;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'category_ids' => 'array',
            'sort' => 'array',
            'price' => 'array',
        ]);

        $categoryIds = $validatedData['category_ids'] ?? [];

        $price = $validatedData['price'] ?? [];

        $sort = $validatedData['sort'] ?? [];

        $query = Product::with('category', 'feedbacks');

        $query->orderBy($sort['column'] ?? 'name', $sort['type'] ?? 'asc');

        if(!empty($categoryIds)) {

            $query->whereIn('category_id', $categoryIds);
        }

        if(!empty($price['min'])) {
            $query->where('price', '>=', $price['min']);
        }

        if(!empty($price['max'])) {
            $query->where('price', '<=', $price['max']);
        }

        return ProductResource::collection($query->paginate(20))->additional(['meta' => [
            'max_price' => Product::max('price'),
            'min_price' => Product::min('price'),
        ]]);
    }

    public function search(Request $request)
    {
        return ProductResource::collection(Product::search($request->get('search'))->get());
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

        $product->fill($request->all());

        $product->save();

        $product = $product->fresh();

        return ProductResource::make($product->load('category', 'feedbacks'));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        return ProductResource::make($product->load('category', 'feedbacks'));
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

        return ProductResource::make($product->load('category', 'feedbacks'));
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

    public function addFavorites(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => ['integer', 'required', 'exists:products,id'],
        ]);

        /** @var User $user */
        $user = $request->user();

        $user->favorites()->attach($validatedData['product_id']);

        return response()->json();
    }

    public function removeFavorites(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => ['integer', 'required', 'exists:products,id'],
        ]);

        /** @var User $user */
        $user = $request->user();

        $user->favorites()->detach($validatedData['product_id']);

        return response()->json();
    }

    public function usersFavorites(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $products =  $user->favorites()->with(['category', 'feedbacks'])->get();

        return ProductResource::collection($products);
    }
}
