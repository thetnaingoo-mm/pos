<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = min(max($request->integer('per_page', 15), 1), 100);

        return BrandResource::collection(
            Brand::query()
                ->orderByDesc('id')
                ->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = Brand::query()->create($request->validated());

        return new BrandResource($brand);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return new BrandResource($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->validated());

        return new BrandResource($brand);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response()->noContent();
    }
}

