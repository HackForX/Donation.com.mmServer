<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Natebanzay\CreateNatebanzayRequest;
use App\Http\Resources\NatebanzayResource;
use App\Models\Natebanzay;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NatebanzayController extends Controller
{

    public function index()
    {
        $natebanzays = Natebanzay::all();
        return ResponseHelper::success(NatebanzayResource::collection($natebanzays));
    }
    public function store(CreateNatebanzayRequest $request): JsonResponse
    {
        return $this->handleTransaction(function () use ($request) {
            $data = $request->validated();
            $photos = $request->file('photos');

            // Handle Photo Uploads (if any)
            $uploadedPhotos = [];
            if ($photos && is_array($photos)) { // Check if $photos is an array
                foreach ($photos as $photo) {
                    $fileName = uniqid() . '-' . $photo->getClientOriginalName();

                    // Validate image file (optional, adjust validation rules as needed)
                    $validator = Validator::make(['image' => $photo], [
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                    ]);

                    if ($validator->fails()) {
                        return response()->json([
                            'message' => 'Invalid photo(s) uploaded.',
                            'errors' => $validator->errors(),
                        ], 422);
                    }

                    $photo->storeAs('public/images/natebanzay_photos', $fileName);
                    $uploadedPhotos[] = $fileName;
                }
                $data['photos'] = json_encode(str_replace('\\', '', $uploadedPhotos));
            }

            $natebanzay = Natebanzay::create($data);

            return $this->responseHelper->success($natebanzay->load('user'), "Natebanzay Created Successfully");
        });
    }

    public function approve(Request $request, string $id)
    {
        return $this->handleTransaction(function () use ($request, $id) {
            $natebanzay = Natebanzay::findOrFail($id);
            $natebanzay->update([
                'status' => 'approved'
            ]);
            return $this->responseHelper->success($natebanzay, "Natebanzay Request Approved Successfully");
        });
    }

    public function refuse(Request $request, string $id)
    {
        return $this->handleTransaction(function () use ($request, $id) {
            $natebanzay = Natebanzay::findOrFail($id);
            $natebanzay->update([
                'status' => 'denied'
            ]);
            return $this->responseHelper->success($natebanzay, "Natebanzay Request Approved Successfully");
        });
    }
}
