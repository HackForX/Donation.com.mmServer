<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Item\CreateItemRequest;
use App\Http\Requests\Api\Admin\Item\UpdateItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        return ResponseHelper::success(ItemResource::collection($items));
    }

    public function store(CreateItemRequest $request): JsonResponse
    {
        return $this->handleTransaction(function () use ($request) {
            $item = Item::create($request->all());
            return $this->responseHelper->success($item, "Item Created Successfully");
        });
    }

    public function edit(UpdateItemRequest  $request, string $id)
    {
        return $this->handleTransaction(function () use ($request, $id) {
            $item = Item::findOrFail($id);
            $item->update($request->all());
            return $this->responseHelper->success($item, "Item Updated Successfully");
        });
    }



    public function destroy(string $id)
    {
        return $this->handleTransaction(function () use ($id) {
            $item = Item::findOrFail($id);
            $item->delete();

            return $this->responseHelper->success($item, "Item Deleted Successfully");
        });
    }
}
