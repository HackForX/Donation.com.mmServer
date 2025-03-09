<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\City\CreateCityRequest;
use App\Http\Requests\Api\Admin\City\UpdateCityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Throwable;

class CityController extends Controller
{


    public function index()
    {
        $cities = City::all();
        return ResponseHelper::success(CityResource::collection($cities));
    }



    public function store(CreateCityRequest $request): JsonResponse
    {
        return $this->handleTransaction(function () use ($request) {
            $city = City::create($request->all());
            return $this->responseHelper->success($city, "City Created Successfully");
        });
    }

    public function edit(UpdateCityRequest $request, string $id)
    {
        return $this->handleTransaction(function () use ($request, $id) {
            $city = City::findOrFail($id);
            $city->update($request->all());
            return $this->responseHelper->success($city, "City Updated Successfully");
        });
    }



    public function destroy(string $id)
    {
        return $this->handleTransaction(function () use ($id) {
            $city = City::findOrFail($id);
            $city->delete();

            return $this->responseHelper->success($city, "City Deleted Successfully");
        });
    }
    public function bulkDelete(Request $request)
    {
     
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:cities,id', 
        ]);

        $ids = $request->input('ids');
        City::whereIn('id', $ids)->delete();

        return response()->json(['message' => 'Cities deleted successfully']);
    }


}
