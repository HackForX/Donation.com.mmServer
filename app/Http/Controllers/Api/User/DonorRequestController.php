<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Donor\CreateDonorRequest;
use App\Models\DonorRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonorRequestController extends Controller
{


    public function store(CreateDonorRequest $request): JsonResponse
    {
        return $this->handleTransaction(function () use ($request) {

            $user = Auth::user();
            if ($user->hasRole('donor')) {
                return ResponseHelper::error(null, "Donors cannot create new donor requests", JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            $existingRequest = DonorRequest::where('user_id', $user->id)->first();
            if ($existingRequest) {
                return ResponseHelper::error(null, "You have already made a donor request", JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            // Upload the image
            $imagePath = $request->file('document')->store('images/donor_request_photos', 'public');

            // Create donor request
            $donorRequest = DonorRequest::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'business'=>$request->input('business'),
                'position'=>$request->input('position'),
                'user_id' => Auth::user()->id,
                'document' => $imagePath,
                'status' => 'pending',
                'document_number' => $request->input('document_number')
            ]);

            return $this->responseHelper->success($donorRequest, "Donor Request Created Successfully");
        });
    }
}
