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
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(UserLoginRequest $request)
    {


        $user = User::where('phone', $request->phone)->first();

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

    public function me()
    {
        $user = Auth::user();
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
            // Handle Socialite exceptions more specifically

            return   response()->json(['error' => $exception->getMessage()], 422);
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
    
public function appleLogin(Request $request)
{
    $request->validate([
        'token' => 'required|string',
    ]);

    $token = $request->input('token');
    $clientSecret = $this->createClientSecret();

    // Exchange the authorization code for a token
    $response = Http::asForm()->post('https://appleid.apple.com/auth/token', [
        'grant_type' => 'authorization_code',
        'code' => $token,
        'redirect_uri' => config('services.apple.redirect'),
        'client_id' => config('services.apple.client_id'),
        'client_secret' => $clientSecret,
    ]);

    if ($response->failed()) {
        return response()->json(['error' => 'Invalid token or client secret'], 400);
    }

    $appleUser = $response->json();
    $idToken = $appleUser['id_token'] ?? null;

    if (!$idToken) {
        return response()->json(['error' => 'ID token missing'], 400);
    }

    // Fetch Apple's public keys
    $appleKeys = Http::get('https://appleid.apple.com/auth/keys')->json();
    $keys = JWK::parseKeySet($appleKeys);

    try {
        $decodedIdToken = JWT::decode($idToken, $keys);
    } catch (\Exception $e) {
        Log::error('Error decoding ID token: ' . $e->getMessage());
        return response()->json(['error' => 'Error decoding ID token'], 422);
    }

    // Extract necessary user information
    $sub = $decodedIdToken->sub ?? null;
    $name = $decodedIdToken->name ?? '--';


    if (!$sub) {
        return response()->json(['error' => 'Unique identifier (sub) not provided in ID token'], 400);
    }

    // Try to find the user by unique identifier (sub)
    $user = User::where('phone', $sub)->first();

    if (!$user) {
        // Create a new user if not found
        $user = User::create([
            'phone' => $sub,
            'name' => $name,
            'password' => bcrypt(Str::random(16)), // Generate a random password
        ]);

        $user->assignRole('user');
    }

    $token = $user->createToken('token-name')->accessToken;

    return response()->json([
        'token' => $token,
        'user' => new UserResource($user),
        'message' => 'Your account is created successfully'
    ], 201);
}


    private function createClientSecret()
    {
        $keyFile = storage_path('app/apple/AuthKey_' . config('services.apple.key_id') . '.p8');
        $key = file_get_contents($keyFile);

        $headers = [
            'alg' => 'ES256',
            'kid' => config('services.apple.key_id'),
        ];

        $claims = [
            'iss' => config('services.apple.team_id'),
            'iat' => time(),
            'exp' => time() + 86400 * 180, // 6 months
            'aud' => 'https://appleid.apple.com',
            'sub' => config('services.apple.client_id'),
        ];

        return JWT::encode($claims, $key, 'ES256', config('services.apple.key_id'), $headers);
    }

    protected function validateProvider($provider)
    {
        $allowedProviders = ['google', 'facebook', 'apple'];

        if (!in_array($provider, $allowedProviders)) {
            return response()->json(['error' => 'Please login using google or facebook or apple'], 422);
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
    public function deleteAccount()
    {
        return $this->handleTransaction(function () {
            $user = auth()->user();
    
            if ($user) {
                $user->delete();
    
                return $this->responseHelper->success(null, "User Deleted Successfully");
            } else {
                return $this->responseHelper->error("User not found or not authenticated", 404);
            }
        });
    }
}
