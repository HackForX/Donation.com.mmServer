<?php

namespace App\Http\Controllers\Api\User;

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


            // Upload the image
            $imagePath = $request->file('document')->store('images', 'public');

            // Create donor request
            $donorRequest = DonorRequest::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'user_id' => Auth::user()->id,
                'document' => $imagePath,
                'status'=>'pending',
                'document_number' => $request->input('document_number')
            ]);

            return $this->responseHelper->success($donorRequest, "Donor Request Created Successfully");
        });
    }

}
