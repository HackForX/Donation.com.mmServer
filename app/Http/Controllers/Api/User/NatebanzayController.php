<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Natebanzay\CreateNatebanzayRequest;
use App\Http\Requests\Api\User\Natebanzay\UpdateNatebanzayRequest;
use App\Http\Requests\Api\User\NatebanzayRequest as RequestNatebanzay;
use App\Http\Resources\NatebanzayRequestResource;
use App\Http\Resources\NatebanzayResource;
use App\Mail\NatebanzayCreated;
use App\Models\Natebanzay;
use App\Models\NatebanzayRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator as FacadesValidator;


class NatebanzayController extends Controller
{
    //

    public function index()
    {
        $natebanzay = Natebanzay::where('status', 'approved')->get();
        return ResponseHelper::success(NatebanzayResource::collection($natebanzay));
    }

    public function get(string $id)
    {
        $natebanzay = Natebanzay::where('id', $id)->first();

        return ResponseHelper::success(NatebanzayResource::make($natebanzay));
    }

    public function natebanzay()
    {
        $natebanzay = Natebanzay::all();
        return ResponseHelper::success(NatebanzayResource::collection($natebanzay));
    }


    public function natebanzayRequests()
    {
        $natebanzayRequests = NatebanzayRequest::where('user_id', Auth::user()->id,)->get();
        return ResponseHelper::success(NatebanzayRequestResource::collection($natebanzayRequests));
    }

    public function natebanzayRequested()
    {
        $natebanzaysRequsted = Natebanzay::where('user_id', Auth::user()->id,)->get();
        return ResponseHelper::success(NatebanzayResource::collection($natebanzaysRequsted));
    }

    public function requestNatebanzay(RequestNatebanzay $request)
    {
        $natebanzay = Natebanzay::where('user_id', Auth::user()->id)->where('id', $request->input('natebanzay_id'))
            ->first();
        if ($natebanzay) {
            return ResponseHelper::error(null, "You can not request", JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
        $existingRequest = NatebanzayRequest::where('user_id', Auth::user()->id)
            ->where('natebanzay_id', $request->input('natebanzay_id'))
            ->first();

        if ($existingRequest) {
            return ResponseHelper::error($existingRequest, "Already requested", JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
        $natebanzayRequest = NatebanzayRequest::create([
            'user_id' => Auth::user()->id,
            'natebanzay_id' => $request->input('natebanzay_id'),
            'status' => 'pending'

        ]);
        return $this->responseHelper->success($natebanzayRequest, "Natebanzay Request Created Successfully");
    }


public function store(CreateNatebanzayRequest $request): JsonResponse
{
    return $this->handleTransaction(function () use ($request) {
        $user = Auth::user();

        if ($user->hasRole('donor')) {
            $data = $request->validated();
            $photos = $request->file('photos');

            // Handle Photo Uploads (if any)
            $uploadedPhotos = [];
            if ($photos && is_array($photos)) {
                foreach ($photos as $photo) {
                    $fileName = uniqid() . '-' . $photo->getClientOriginalName();

                    // Validate image file
                    $validator = FacadesValidator::make(['image' => $photo], [
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
                $data['photos'] = json_encode($uploadedPhotos);
            }

            $natebanzay = Natebanzay::create($data);

            // Send email to admins
            $adminEmails = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->pluck('email')->toArray();

            // Send the email
            Mail::to($adminEmails)->send(new  NatebanzayCreated($natebanzay));

            return $this->responseHelper->success($natebanzay->load('user'), "Natebanzay Created Successfully");
        } else {
            return ResponseHelper::error(null, "Only donors can create Natebanzay", JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
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
                    $validator = FacadesValidator::make(['image' => $photo], [
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

            return $this->responseHelper->success($natebanzay, "Natebanzay Updated Successfully");
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
}
