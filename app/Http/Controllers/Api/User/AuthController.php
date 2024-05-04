<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\LoginRequest as UserLoginRequest;
use App\Http\Requests\Api\User\RegisterRequest as UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
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

    public function redirectToProvider($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        $url = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
        return ResponseHelper::success($url, "Url generated");
    }

    public function handleProviderCallback($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        $userCreated = User::firstOrCreate(
        
            [
                'name' => $user->getName(),
          
            ]
        );
        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'profile' => $user->getAvatar()
            ]
        );
        $token = $userCreated->createToken('token-name')->accessToken;

        return response()->json([
            'token' =>  $token,
            'user' => new UserResource($user),
            'message' => 'Your account is created successfully'
        ], 201);
    }

    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'github', 'google'])) {
            return response()->json(['error' => 'Please login using facebook, github or google'], 422);
        }
    }
}
