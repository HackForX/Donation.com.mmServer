<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\TownshipResource;
use App\Models\Township;
use Illuminate\Http\Request;

class TownshipController extends Controller
{
    public function index(string $id)
    {
        $townships = Township::where('city_id',$id)->get();
        if ($townships->isEmpty()) {
            return ResponseHelper::success(TownshipResource::collection([]));
        }
        return ResponseHelper::success(TownshipResource::collection($townships));
    }

}
