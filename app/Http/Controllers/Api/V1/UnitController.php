<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Http\Resources\UnitResource;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = min(max($request->integer('per_page', 15), 1), 100);

        return UnitResource::collection(
            Unit::query()
                ->orderByDesc('id')
                ->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnitRequest $request)
    {
        $unit = Unit::query()->create($request->validated());

        return new UnitResource($unit);
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        return new UnitResource($unit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $unit->update($request->validated());

        return new UnitResource($unit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();

        return response()->noContent();
    }
}

