<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\LoginRequest as UserLoginRequest;
use App\Http\Requests\Api\User\RegisterRequest as UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AuthController extends Controller
{
    public function login(UserLoginRequest $request)
    {


        $user = User::where('phone', $request->phone)->role('user')->first();

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

    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ])->assignRole('user');
        // $requestDonorPermission = Permission::findByName('requestDonor');
        // $user->givePermissionTo($requestDonorPermission);
        $token = $user->createToken($user->phone . '_' . now())->accessToken;
        return response()->json([
            'token' =>  $token,
            'user' => new UserResource($user),
            'message' => 'Your account is created successfully'
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
