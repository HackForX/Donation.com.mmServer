<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Township\CreateTownshipRequest;
use App\Http\Requests\Api\Admin\Township\UpdateTownshipRequest;
use App\Http\Resources\TownshipResource;
use App\Models\City;
use App\Models\Township;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TownshipController extends Controller
{

    public function index()
    {
        $townships = Township::all();
        return ResponseHelper::success(TownshipResource::collection($townships));
    }



    public function store(CreateTownshipRequest $request): JsonResponse
    {
        return $this->handleTransaction(function () use ($request) {
            $townshipData = $request->all();
            $townshipData['city_name'] = City::find($request->city_id)->name;

            $township = Township::create($townshipData);
            return $this->responseHelper->success($township, "Township Created Successfully");
        });
    }

    public function edit(UpdateTownshipRequest $request, string $id)
    {
        return $this->handleTransaction(function () use ($request, $id) {
            $township = Township::findOrFail($id);
    
            // Update city name using City model
            $township->city_name = City::find($request->city_id)->name;
    
            // Update other fields directly on the township object
            $township->fill($request->toArray());  // Mass assignment (assuming validation)
    
            $township->save(); // Update the township directly
    
            return $this->responseHelper->success($township->toArray(), "Township Updated Successfully");
        });

    }



    public function destroy(string $id)
    {
        return $this->handleTransaction(function () use ($id) {
            $township = Township::findOrFail($id);
            $township->delete();

            return $this->responseHelper->success($township, "Township Deleted Successfully");
        });
    }
}
