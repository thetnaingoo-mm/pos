<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = min(max($request->integer('per_page', 15), 1), 100);

        return ProductResource::collection(
            Product::query()
                ->with(['category', 'brand', 'unit'])
                ->orderByDesc('id')
                ->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::query()
            ->create($request->validated());

        return new ProductResource($product->load(['category:id,name', 'brand:id,name', 'unit:id,name']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product->loadMissing(['category', 'brand', 'unit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return new ProductResource($product->load(['category', 'brand', 'unit']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->noContent();
    }
}

