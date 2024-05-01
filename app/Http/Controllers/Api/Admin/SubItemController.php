<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\SubItem\CreateSubItemRequest;
use App\Http\Requests\Api\Admin\SubItem\UpdateSubItemRequest;
use App\Http\Resources\SubItemResource;
use App\Models\SubItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubItemController extends Controller
{

    public function index()
    {
        $subItems = SubItem::all();
        return ResponseHelper::success(SubItemResource::collection($subItems));
    }



    public function store(CreateSubItemRequest $request): JsonResponse
    {
        return $this->handleTransaction(function () use ($request) {
            $subItem = SubItem::create($request->all());
            return $this->responseHelper->success($subItem, "SubItem Created Successfully");
        });
    }

    public function edit(UpdateSubItemRequest $request, string $id)
    {
        return $this->handleTransaction(function () use ($request, $id) {
            $subItem = SubItem::findOrFail($id);
            $subItem->update($request->all());
            return $this->responseHelper->success($subItem, "SubItem Updated Successfully");
        });
    }



    public function destroy(string $id)
    {
        return $this->handleTransaction(function () use ($id) {
            $subItem = SubItem::findOrFail($id);
            $subItem->delete();

            return $this->responseHelper->success($subItem, "SubItem  Deleted Successfully");
        });
    }
}
