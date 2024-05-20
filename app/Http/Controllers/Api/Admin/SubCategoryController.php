<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\SubCategory\CreateSubCategoryRequest;
use App\Http\Requests\Api\Admin\SubCategory\UpdateSubCategoryRequest;
use App\Http\Resources\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::all();
      
        return ResponseHelper::success(SubCategoryResource::collection($subCategories));
    }



    public function store(CreateSubCategoryRequest $request): JsonResponse
    {
        return $this->handleTransaction(function () use ($request) {
            $subCategory = SubCategory::create($request->all());
            return $this->responseHelper->success(SubCategoryResource::make($subCategory), "SubCategory Created Successfully");
        });
    }

    public function edit(UpdateSubCategoryRequest $request, string $id)
    {
        return $this->handleTransaction(function () use ($request, $id) {
            $subCategory = SubCategory::findOrFail($id);
            $subCategory->update($request->all());
            return $this->responseHelper->success(SubCategoryResource::make($subCategory), "SubCategory Updated Successfully");
        });
    }



    public function destroy(string $id)
    {
        return $this->handleTransaction(function () use ($id) {
            $subCategory = SubCategory::findOrFail($id);
            $subCategory->delete();

            return $this->responseHelper->success(SubCategoryResource::make($subCategory), "SubCategory  Deleted Successfully");
        });
    }
}
