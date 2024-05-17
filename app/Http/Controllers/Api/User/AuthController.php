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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Stringable;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

use Carbon\Carbon;

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
            'age' => $request->age,
            'gender' => $request->gender
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

    public function userExists(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $phone = $request->input('phone');
        $userExists = User::where('phone', $phone)->exists();

        if ($userExists) {
            return response()->json(['exist' => true]);
        } else {
            return response()->json(['exist' => false]);
        }
    }

    public function me(){
        $user=Auth::user();
        return ResponseHelper::success(UserResource::make($user));
    }
    public function forgotPassword(Request $request)
    {
        $request->validate(['phone' => 'required|string']);

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Generate a random token
        $token = Str::random(60);

        $passwordReset = DB::table('password_resets')->where('phone', $request->phone)->first();

        if ($passwordReset) {
            // Update the existing record with the new token and timestamp
            DB::table('password_resets')
                ->where('phone', $request->phone)
                ->update([
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
        } else {
            // Insert a new record
            DB::table('password_resets')->insert([
                'phone' => $user->phone,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }

        // Optionally, you can return the token in the response
        // This should ideally be sent via a secure channel
        return response()->json(['token' => $token, 'message' => 'Reset token generated.']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'token' => 'required|string',
            'password' => 'required|string'
        ]);

        $passwordReset = DB::table('password_resets')->where([
            'phone' => $request->phone,
            'token' => $request->token
        ])->first();

        if (!$passwordReset) {
            return response()->json(['message' => 'Invalid token or username'], 400);
        }

        // Check if the token has expired (e.g., 1-hour expiry time)
        if (Carbon::parse($passwordReset->created_at)->addHour()->isPast()) {
            return response()->json(['message' => 'Token has expired'], 400);
        }

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the password reset token
        DB::table('password_resets')->where([
            'phone' => $request->phone,
            'token' => $request->token
        ])->delete();

        return response()->json(['message' => 'Password has been reset successfully.']);
    }


    public function loginWithToken(Request $request, $provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        $validator = FacadesValidator::make($request->all(), [
            'access_token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid access token provided.'], 422);
        }

        try {
            $user = Socialite::driver($provider)->stateless()->userFromToken($request->input('access_token'));
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        $userCreated = User::firstOrCreate(

            [
                'name' => $user->getName(),
                'phone' => $user->getEmail(), // set a random password

            ]
        )->assignRole('user');

        $token = $userCreated->createToken('token-name')->accessToken;

        return response()->json([
            'token' => $token,
            'user' => new UserResource($userCreated),
            'message' => 'Your account is created successfully'
        ], 201);
    }

    protected function validateProvider($provider)
    {
        $allowedProviders = ['google', 'facebook'];

        if (!in_array($provider, $allowedProviders)) {
            return response()->json(['error' => 'Please login using google or facebook'], 422);
        }
    }

    // public function redirectToProvider($provider)
    // {
    //     $validated = $this->validateProvider($provider);
    //     if (!is_null($validated)) {
    //         return $validated;
    //     }

    //     $url = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
    //     return ResponseHelper::success($url, "Url generated");
    // }

    // public function handleProviderCallback($provider)
    // {
    //     $validated = $this->validateProvider($provider);
    //     if (!is_null($validated)) {
    //         return $validated;
    //     }
    //     try {
    //         $user = Socialite::driver($provider)->stateless()->user();
    //     } catch (ClientException $exception) {
    //         return response()->json(['error' => 'Invalid credentials provided.'], 422);
    //     }



    //     $userCreated = User::firstOrCreate(

    //         [
    //             'name' => $user->getName(),
    //             'phone' => $user->getEmail()
    //         ]
    //     );
    //     // $userCreated->providers()->updateOrCreate(
    //     //     [
    //     //         'provider' => $provider,
    //     //         'provider_id' => $user->getId(),
    //     //     ],
    //     //     [
    //     //         'profile' => $user->getAvatar()
    //     //     ]
    //     // );
    //     $token = $userCreated->createToken('token-name')->accessToken;

    //     return response()->json([
    //         'token' =>  $token,
    //         'user' => new UserResource($user),
    //         'message' => 'Your account is created successfully'
    //     ], 201);
    // }

    // protected function validateProvider($provider)
    // {
    //     if (!in_array($provider, ['facebook', 'github', 'google'])) {
    //         return response()->json(['error' => 'Please login using facebook, github or google'], 422);
    //     }
    // }
}
