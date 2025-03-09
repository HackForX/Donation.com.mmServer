<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\DonorRequest\ApproveDonorRequest;
use App\Http\Requests\Api\User\Donor\CreateDonorRequest;
use App\Http\Resources\DonorRequestResource;
use App\Models\DonorRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonorRequestController extends Controller
{

    public function index()
    {
        $donorRequests = DonorRequest::all();
        return ResponseHelper::success(DonorRequestResource::collection($donorRequests));
    }


    public function approve(Request $request, string $id)
    {
        return $this->handleTransaction(function () use ($request, $id) {
            $donorRequest = DonorRequest::findOrFail($id);
            $donorRequest->update([
                'status' => 'approved'
            ]);
            $user = User::find($donorRequest->user_id);
            $user->assignRole('donor');
            $donorRequest->delete();
            return $this->responseHelper->success($donorRequest, "Donor Request Approved Successfully");
        });
    }

    public function denie(Request $request, string $id)
    {
        return $this->handleTransaction(function () use ($request, $id) {
            $donorRequest = DonorRequest::findOrFail($id);
            $donorRequest->update([
                'status' => 'denied'
            ]);
            return $this->responseHelper->success($donorRequest, "Donor Request Denied Successfully");
        });
    }
    public function destroy(Request $request, string $id)
    {
        return $this->handleTransaction(function () use ($request, $id) {
            $donorRequest = DonorRequest::findOrFail($id);
            $donorRequest->delete();
            return $this->responseHelper->success($donorRequest, "Donor Request Deleted Successfully");
        });
    }
}
