<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = min(max($request->integer('per_page', 15), 1), 100);

        return LocationResource::collection(
            Location::query()
                ->orderByDesc('id')
                ->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        $location = Location::query()->create($request->validated());

        return new LocationResource($location);
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        return new LocationResource($location);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        $location->update($request->validated());

        return new LocationResource($location);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return response()->noContent();
    }
}

