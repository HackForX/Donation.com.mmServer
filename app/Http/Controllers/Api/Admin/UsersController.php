<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role as ModelsRole;

class UsersController extends Controller
{
    public function donors()
    {
        $donorRole = ModelsRole::findByName('donor', 'api');
        if (!$donorRole) {
            return ResponseHelper::error('Donor role not found', 404);
        }

        $donorUsers = $donorRole->users()->where('is_show', true)->get();

        return ResponseHelper::success(UserResource::collection($donorUsers));
    }

    public function profile()
    {
        $user = Auth::user();

        if (!$user) {
            return ResponseHelper::error('Unauthenticated', 401);
        }

        return ResponseHelper::success(new UserResource($user));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return ResponseHelper::error('Unauthenticated', 401);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'phone' => 'sometimes|string|max:20',
            'age' => 'sometimes',
            'address' => 'sometimes',
            'profile' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('profile')) {
            // Delete old image if exists
            if ($user->profile) {
                Storage::delete('public/profiles/' . $user->profile);
            }

            $imageName = time() . '.' . $request->profile->extension();
            $request->profile->storeAs('public/profiles', $imageName);
            $validated['profile'] = $imageName;
        }

        $user->update($validated);

        return ResponseHelper::success(new UserResource($user), 'Profile updated successfully');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole('admin')) {
            return ResponseHelper::error('Unauthorized. Admin access required.', 403);
        }

        $validated = $request->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|different:current_password',
            'new_password_confirmation' => 'required|same:new_password'
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return ResponseHelper::error(null,'Current password is incorrect');
        }

        $user->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        return ResponseHelper::success(null, 'Password changed successfully');
    }

    public function users()
    {
        $userRole = ModelsRole::findByName('user', 'api');
        if (!$userRole) {
            return ResponseHelper::error('User role not found', 404);
        }

        $normalUsers = $userRole->users()->get(); // Added get() to execute the query

        return ResponseHelper::success(UserResource::collection($normalUsers));
    }

    public function admins()
    {
        $adminRole = ModelsRole::findByName('admin', 'api');
        if (!$adminRole) {
            return ResponseHelper::error('Admin role not found', 404);
        }

        $admins = $adminRole->users()->get(); // Added get() to execute the query

        return ResponseHelper::success(UserResource::collection($admins));
    }

    public function destroy(string $id){
        return $this->handleTransaction(function () use ($id) {
            $user = User::findOrFail($id);
            $user->delete();

            return $this->responseHelper->success($user, "User Deleted Successfully");
        });
    }
}
