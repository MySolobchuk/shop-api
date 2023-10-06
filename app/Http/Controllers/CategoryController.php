<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'sort' => 'array',
            'perPage' => 'integer'
        ]);


        $sort = $validatedData['sort'] ?? [];

        $query = Category::with('products', 'parent', 'children');

        $query->orderBy($sort['column'] ?? 'name', $sort['type'] ?? 'asc');

        return CategoryResource::collection($query->paginate($validatedData['perPage'] ?? 20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return CategoryResource
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());

        $category = $category->fresh();

        return CategoryResource::make($category->load('products', 'parent', 'children'));
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category)
    {
        return CategoryResource::make($category->load('products', 'parent', 'children'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return CategoryResource
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return CategoryResource::make($category->load('products', 'parent', 'children'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(null, 204);
    }
}
