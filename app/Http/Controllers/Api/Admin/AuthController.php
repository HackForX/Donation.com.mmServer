<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Auth\LoginRequest as AdminLoginRequest;
use App\Http\Requests\Api\Admin\Auth\RegisterRequest as AdminRegisterRequest;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(AdminLoginRequest $request)
    {

        $user = User::where('name', $request->name)->role('admin')->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken($user->phone . '_' . now())->accessToken;
                return response()->json([
                    'token' =>  $token,
                    'user' => new UserResource($user),
                    'message' => 'Successfully Logined'
                ], 200);
            } else {
                return response()->json(['message' => 'Invalid phone number or password'], 401);
            }
        } else {
            return response()->json(['message' => 'Invalid phone number or password'], 401);
        }
    }

    public function register(AdminRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ])->assignRole('admin');

        $token = $user->createToken($user->phone . '_' . now())->accessToken;
        return response()->json([
            'token' =>  $token,
            'user' => new UserResource($user),
            'message' => 'Account is created successfully'
        ], 201);
    }


    public function registerDonor(AdminRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ])->assignRole('donor');

        $token = $user->createToken($user->phone . '_' . now())->accessToken;
        return response()->json([
            'token' =>  $token,
            'data' => new UserResource($user),
            'message' => 'Account is created successfully'
        ], 201);
    }


    public function logout()
    {
        $user = User::find(Auth::id());
        if ($user) {
            $user->tokens()->delete();
            return response()->json(['message' => 'Successfully logout',], 200);
        } else {
            return response()->json(['message' => 'User not found'], 200);
        }
    }
}
