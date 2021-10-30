<?php

namespace App\Http\Controllers;

use App\Facades\ResponseHelper;
use App\Models\City;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @package City
 */
class CityController extends Controller
{
    /**
     * City: Display a listing of the City resource.
     *
     * City List
     * @group Cities
     * @responseFile scribe/cities/cities.json
     * @return Builder[]|Collection
     */
    public function index()
    {
        return City::query()->orderBy('name')->get();
    }

    /**
     * City: Store a newly created City resource in storage.
     *
     * City Store
     * @bodyParam name string required Name of city. Example Durham
     * @group Cities
     * @responseFile scribe/cities/city.json
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $city = City::query()->create($request->input());
        return response()->json($city, Response::HTTP_CREATED);
    }

    /**
     * City: Display the specified City resource.
     *
     * City Show
     * @group Cities
     * @responseFile scribe/cities/city.json
     * @param City $city
     * @return JsonResponse
     */
    public function show(City $city): JsonResponse
    {
        return response()->json($city, Response::HTTP_OK);
    }

    /**
     * City: Update the specified resource in storage.
     *
     * City Update
     * @urlParam city Id of City resource
     * @bodyParam name string required Name of city. Example Durham
     * @group Cities
     * @responseFile scribe/cities/city.json
     * @param Request $request
     * @param City $city
     * @return City
     */
    public function update(Request $request, City $city): JsonResponse
    {
        $city->update($request->input());
        return response()->json($city, Response::HTTP_OK);
    }

    /**
     * City: Remove the specified City resource from storage.
     *
     * City Destroy
     * @urlParam city Id of City resource
     * @group Cities
     * @param City $city
     * @return JsonResponse
     * @throws \Throwable
     */
    public function destroy(City $city): JsonResponse
    {
        $city->deleteOrFail();
        return ResponseHelper::renderSuccess();
    }

    /**
     * City: Restore deleted City resource
     *
     * City Restore
     * @urlParam id Id of City to restore
     * @group Cities
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        $city = City::withTrashed()->findOrFail($id);
        $city->restore();
        return response()->json($city, Response::HTTP_OK);
    }
}
