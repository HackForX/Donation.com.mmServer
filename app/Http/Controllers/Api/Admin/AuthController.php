<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Auth\LoginRequest as AdminLoginRequest;
use App\Http\Requests\Api\Admin\Auth\RegisterRequest as AdminRegisterRequest;

use App\Http\Resources\UserResource;
use App\Models\PasswordReset;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
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
            'email'=>$request->email
        ])->assignRole('admin');

        $token = $user->createToken($user->phone . '_' . now())->accessToken;
        return response()->json([
            'token' =>  $token,
            'user' => new UserResource($user), 'message' => 'Account is created successfully'
        ], 201);
    }


    public function registerDonor(AdminRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address'=>$request->address,
            'password' => Hash::make($request->password),
        ])->assignRole('donor');

        $token = $user->createToken($user->phone . '_' . now())->accessToken;
        return response()->json([
            'token' =>  $token,
            'data' => new UserResource($user),
            'message' => 'Account is created successfully'
        ], 201);
    }

public function sendResetLinkEmail(Request $request)
    {
        try{
            $user=User::where('email',$request->email)->get();
            if(count($user)>0){
                $token=Str::random(40);
                $domain=URL::to('/');
                $url=$domain.'/reset-password?token='.$token;
                $data['url']=$url;
                $data['email']=$request->email;
                $data['title']="Password reset";
                $data['body']="Please click on below link to reset your password";
                Mail::send('forgotpasswordEmail',['data'=>$data],function($message) use ($data){
                    $message->to($data['email'])->subject($data['title']);
                });

                $datetime=Carbon::now()->format('Y-m-d H:i:s');
                PasswordReset::updateOrCreate([
                    'email'=>$request->email,
                ],['email'=>$request->email,'token'=>$token,'created_at'=>$datetime,'updated_at'=>$datetime]);
   return response()->json(['success'=>true,'msg'=>'Please check your email to reset your password']);

            }else{
   return response()->json(['success'=>false,'msg'=>'Admin not found']);
            }
        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        }
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

    public function resetPasswordLoad(Request $request){
        $resetData=PasswordReset::where('token',$request->token)->get();
        if(isset($request->token)&& count($resetData)>0){
            $user=User::where('email',$resetData[0]['email'])->get();
            return view('resetPassword',compact('user'));
        }else{
            return view('notfound');
        }
    }

        public function resetPassword(Request $request){
            $request->validate([
                'password'=>'required|string|min:6|confirmed'
            ]);
            $user=User::find($request->id);
            $user->password=Hash::make($request->password);
            $user->save();
            PasswordReset::where('email',$user->email)->delete();
            return "<h1>Your password has been reset successfully .";
    }
}
