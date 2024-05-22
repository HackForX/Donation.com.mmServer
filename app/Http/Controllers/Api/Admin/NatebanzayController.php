<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Natebanzay\CreateNatebanzayRequest;
use App\Http\Requests\Api\User\Natebanzay\UpdateNatebanzayRequest;
use App\Http\Resources\NatebanzayResource;
use App\Models\Natebanzay;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role as ModelsRole;

class NatebanzayController extends Controller
{
    public function adminNatebanzays()
    {
        // Fetch the IDs of all users who have the role 'admin'
        $adminRole = ModelsRole::findByName('admin', 'api'); // Get the donor role object

        $adminUserIds = $adminRole->users->pluck('id');

        // Get Natebanzays posted by these admin users
        $natebanzays = Natebanzay::whereIn('user_id', $adminUserIds)->get();

        // Return the Natebanzays with the appropriate resource collection
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

            return $this->responseHelper->success(NatebanzayResource::make($natebanzay), "Natebanzay Created Successfully");
        });
    }

    public function edit(UpdateNatebanzayRequest $request, string $id)
    {
        return $this->handleTransaction(function () use ($request, $id) {
            $natebanzay = Natebanzay::findOrFail($id);

            $validatedData = $request->validated(); // Validate all input data

            // Handle Photo Uploads (if any)
            $uploadedPhotos = [];
            if ($request->hasFile('photos')) {
                $photos = $request->file('photos');

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
            }

            // Update data based on validated input and uploaded photos (if any)
            $dataToUpdate = array_merge($validatedData, [
                'photos' => $uploadedPhotos ? json_encode($uploadedPhotos) : $natebanzay->photos, // Maintain existing photos if none uploaded
            ]);

            $natebanzay->update($dataToUpdate);

            return ResponseHelper::success(NatebanzayResource::make($natebanzay), "Natebanzay Updated Successfully");
        });
    }

    public function destroy(string $id)
    {
        return $this->handleTransaction(function () use ($id) {
            $natebanzay = Natebanzay::findOrFail($id);
            $natebanzay->delete();

            return $this->responseHelper->success($natebanzay, "Natebanzay  Deleted Successfully");
        });
    }


    public function donorNatebanzays()
    {
        // Fetch the IDs of all users who have the role 'admin'
        $adminRole = ModelsRole::findByName('donor', 'api'); // Get the donor role object

        $adminUserIds = $adminRole->users->pluck('id');

        // Get Natebanzays posted by these admin users
        $natebanzays = Natebanzay::whereIn('user_id', $adminUserIds)->get();

        return ResponseHelper::success(NatebanzayResource::collection($natebanzays));
    }


    public function deniedNatebanzays()
    {
        $deniedNatebanzays = Natebanzay::where('status', 'denied')->get();

        return ResponseHelper::success(NatebanzayResource::collection($deniedNatebanzays));
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
            return $this->responseHelper->success($natebanzay, "Natebanzay Request Denied Successfully");
        });
    }
}
