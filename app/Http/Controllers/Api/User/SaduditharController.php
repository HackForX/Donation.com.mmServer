<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Sadudithar\CreateSaduditharRequest;
use App\Http\Resources\SaduditharResource;
use App\Mail\SaduditharCreated;
use App\Models\Sadudithar;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SaduditharController extends Controller
{
    public function index()
    {
        $currentDateTime = Carbon::now();

        // Query to get the upcoming Sadudithars
        $sadudithars = Sadudithar::where('status', 'approved')
            ->where(function ($query) use ($currentDateTime) {
                $query->where('event_date', '>', $currentDateTime)
                    ->orWhere(function ($query) use ($currentDateTime) {
                        $query->whereDate('event_date', '=', $currentDateTime->toDateString())
                            ->whereTime('actual_end_time', '>', $currentDateTime->toTimeString());
                    });
            })
            ->get();

        return ResponseHelper::success(SaduditharResource::collection($sadudithars));
    }


    public function history()
    {
        $currentDateTime = Carbon::now();
        // $currentUser=Auth::guard('api')->user();



        $sadudithars = Sadudithar::where('status', 'approved')

            ->where(function ($query) use ($currentDateTime) {
                $query->where('event_date', '<', $currentDateTime)
                    ->orWhere(function ($query) use ($currentDateTime) {
                        $query->whereDate('event_date', '=', $currentDateTime->toDateString())
                            ->whereTime('actual_end_time', '<', $currentDateTime->toTimeString());
                    });
            })
            ->get();


        return ResponseHelper::success(SaduditharResource::collection($sadudithars));
    }


    public function myDonations()
    {
        $currentDateTime = Carbon::now();
        $currentUser = Auth::guard('api')->user();

        if (!$currentUser) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }


        $sadudithars = Sadudithar::where('status', 'approved')
            ->where('user_id', $currentUser->id)
            ->where(function ($query) use ($currentDateTime) {
                $query->where('event_date', '<', $currentDateTime)
                    ->orWhere(function ($query) use ($currentDateTime) {
                        $query->whereDate('event_date', '=', $currentDateTime->toDateString())
                            ->whereTime('actual_end_time', '<', $currentDateTime->toTimeString());
                    });
            })
            ->get();


        return ResponseHelper::success(SaduditharResource::collection($sadudithars));
    }
    public function get(string $id)
    {
        $sadudithar = Sadudithar::where('id', $id)->first();

        return ResponseHelper::success(SaduditharResource::make($sadudithar));
    }



    public function store(CreateSaduditharRequest $request): JsonResponse
    {
        return $this->handleTransaction(function () use ($request) {




            $user = Auth::user();
            if ($user->hasRole('donor')) {

                $imagePath = $request->file('image')->store('images/sadudithar_photos', 'public');
                $sadudithar = Sadudithar::create([
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'category_id' => $request->input('category_id'),
                    'city_id' => $request->input('city_id'),
                    'township_id' => $request->input('township_id'),
                    'type' => $request->input('type'),
                    'estimated_amount' => $request->input('estimated_amount'),
                    'estimated_time' => $request->input('estimated_time'),
                    'estimated_quantity' => $request->input('estimated_quantity'),
                    'actual_start_time' => $request->input('actual_start_time'),
                    'actual_end_time' => $request->input('actual_end_time'),
                    'event_date' => $request->input('event_date'),
                    'is_open' => $request->input('is_open'),
                    'is_show' => $request->input('is_show'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'image' => $imagePath,
                    'status' => "pending",
                    'latitude' => $request->input('latitude') ?: null,
                    'longitude' => $request->input('longitude') ?: null,
                    'user_id' => $request->input('user_id')

                ]);
                $adminEmails = User::whereHas('roles', function ($query) {
                    $query->where('name', 'admin');
                })->pluck('email')->toArray();

                // Send the email
                Mail::to($adminEmails)->send(new  SaduditharCreated($sadudithar));
                return $this->responseHelper->success($sadudithar->load("category")->load('city')->load('township')->load('user'), "Sadudithar Created Successfully");
            } else {
                return ResponseHelper::error(null, "Only donors can create Sadudithar", JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
        });
    }

    public function getMostViewed()
    {
        $sadudithars = Sadudithar::where('status', 'approved')
            ->withCount('views')
            ->orderBy('views_count', 'desc')
            ->take(10)
            ->get();

        return ResponseHelper::success(SaduditharResource::collection($sadudithars));
    }

    public function getLatest()
    {
        $sadudithars = Sadudithar::where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return ResponseHelper::success(SaduditharResource::collection($sadudithars));
    }


    public function destroy(string $id)
    {
        return $this->handleTransaction(function () use ($id) {
            $sadudithar = Sadudithar::findOrFail($id);
            $sadudithar->delete();

            return $this->responseHelper->success($sadudithar, "Sadudithar  Deleted Successfully");
        });
    }
}
