<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(string $id)
    {
        $subCategories = SubCategory::where('category_id', $id)->get();
        if ($subCategories->isEmpty()) {
            return ResponseHelper::success(SubCategoryResource::collection([]));
        }
        return ResponseHelper::success(SubCategoryResource::collection($subCategories));
    }


}
