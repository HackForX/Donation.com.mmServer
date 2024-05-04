<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Sadudithar\CreateSaduditharRequest;
use App\Http\Resources\SaduditharResource;
use App\Models\Sadudithar;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SaduditharController extends Controller
{
    public function index(){
        $sadudithars=Sadudithar::all();

        return ResponseHelper::success(SaduditharResource::collection($sadudithars));
    }
    public function get(string $id){
        $sadudithar=Sadudithar::where('id',$id)->first();

        return ResponseHelper::success(SaduditharResource::make($sadudithar));
    }
    public function store(CreateSaduditharRequest $request): JsonResponse
    {
        return $this->handleTransaction(function () use ($request) {
            $imagePath = $request->file('image')->store('images/sadudithar_photos', 'public');
            $sadudithar = Sadudithar::create([
                'title' => $request->input('title'),
                'category_id' => $request->input('category_id'),
                'city_id' => $request->input('city_id'),
                'township_id' => $request->input('township_id'),
                'subCategory_id' => $request->input('subCategory_id'),
                'estimated_amount' => $request->input('estimated_amount'),
                'estimated_time' => $request->input('estimated_time'),
                'estimated_quantity' => $request->input('estimated_quantity'),
                'actual_start_time' => $request->input('actual_start_time'),
                'actual_end_time' => $request->input('actual_end_time'),
                'event_date' => $request->input('event_date'),
                'is_open' => $request->input('is_open'),
                'is_show' => $request->input('is_show'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'image' => $imagePath,
                'status' => $request->input('status'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'user_id' => $request->input('user_id')

            ]);

            return $this->responseHelper->success($sadudithar->load("category")->load('city')->load('township')->load('user'), "Sadudithar Created Successfully");
        });
    }


    public function destroy(string $id)
    {
        return $this->handleTransaction(function () use ($id) {
            $sadudithar = Sadudithar::findOrFail($id);
            $sadudithar->delete();

            return $this->responseHelper->success($sadudithar, "Sadudithar  Deleted Successfully");
        });
    }

}
