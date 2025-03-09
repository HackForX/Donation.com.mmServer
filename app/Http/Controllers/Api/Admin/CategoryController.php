<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Category\CreateCategoryRequest;
use App\Http\Requests\Api\Admin\Category\UpdateCategoryRequest;
use App\Http\Requests\Api\Admin\SubCategory\UpdateSubCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $items = Category::with('subCategories')->get();
        return ResponseHelper::success(CategoryResource::collection($items));
    }
    public function store(CreateCategoryRequest $request): JsonResponse
    {
        return $this->handleTransaction(function () use ($request) {
            $category = Category::create($request->validated());
            return $this->responseHelper->success($category, "Category Created Successfully");
        });
    }

    public function edit(UpdateCategoryRequest  $request, string $id)
    {
        return $this->handleTransaction(function () use ($request, $id) {
            $category = Category::findOrFail($id);
            $category->update($request->all());
            return $this->responseHelper->success($category, "Category Updated Successfully");
        });
    }



    public function destroy(string $id)
    {
        return $this->handleTransaction(function () use ($id) {
            $category = Category::findOrFail($id);
            $category->delete();

            return $this->responseHelper->success($category, "Category Deleted Successfully");
        });
    }
}
