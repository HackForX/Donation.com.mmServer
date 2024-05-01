<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubItemResource;
use App\Models\SubItem;
use Illuminate\Http\Request;

class SubItemController extends Controller
{

    public function index(string $id)
    {
        $subItems = SubItem::where('item_id', $id)->get();
        if ($subItems->empty()) {
            return ResponseHelper::success([]);
        }
        return ResponseHelper::success(SubItemResource::collection($subItems));
    }
}
