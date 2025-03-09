<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;

use App\Http\Resources\NatebanzayRequestResource;
use App\Models\Natebanzay;
use App\Models\NatebanzayChat;
use App\Models\NatebanzayRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NatebanzayRequestController extends Controller
{
    public function index(string $id)
    {
        $natebanzay = Natebanzay::where('id', $id)
            ->firstOrFail();


        $natebanzayRequests = NatebanzayRequest::where('natebanzay_id', $natebanzay->id)
            ->get();
        return ResponseHelper::success(NatebanzayRequestResource::collection($natebanzayRequests));
    }

    public function accept(Request $request, string $id): JsonResponse
    {
        return $this->handleTransaction(function () use ($request, $id) {
            $natebanzayRequest = NatebanzayRequest::where('id', $id)->firstOrFail();
            if ($natebanzayRequest->natebanzay->user_id === Auth::user()->id) {
                if ($natebanzayRequest->status == "rejected") {
                    return ResponseHelper::error($natebanzayRequest, "You Already Rejected",);
                }
                if ($natebanzayRequest->status == "accepted") {
                    return ResponseHelper::error($natebanzayRequest, "You Already Accepted",);
                }
                $natebanzayRequest->update([
                    'status' => 'accepted'
                ]);

                $natebanzayChat = NatebanzayChat::create([
                    'requester_id' => $natebanzayRequest->user_id,
                    'uploader_id' => $natebanzayRequest->natebanzay->user_id

                ]);
            } else {
                return ResponseHelper::error($natebanzayRequest, "You cant accept another user's donation",);
            }
            return ResponseHelper::success(NatebanzayRequestResource::make($natebanzayRequest), "Accepted Successfully");
        });
    }

    public function reject(Request $request, string $id): JsonResponse
    {
        return $this->handleTransaction(function () use ($request, $id) {
            $natebanzayRequest = NatebanzayRequest::where('id', $id)->firstOrFail();
            if ($natebanzayRequest->natebanzay->user_id === Auth::user()->id) {
                if ($natebanzayRequest->status == "accepted") {
                    return ResponseHelper::error($natebanzayRequest, "You Already Accepted",);
                }
                if ($natebanzayRequest->status == "rejected") {

                    return ResponseHelper::error($natebanzayRequest, "You Already Rejected",);
                }
                $natebanzayRequest->update([
                    'status' => 'rejected'
                ]);
            } else {
                return ResponseHelper::error($natebanzayRequest, "You can't reject another user's donation",);
            }

            return ResponseHelper::success(NatebanzayRequestResource::make($natebanzayRequest), "Rejected Successfully");
        });
    }
}
