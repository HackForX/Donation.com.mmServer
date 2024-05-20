<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role as ModelsRole;

class UsersController extends Controller
{
    public function donors()
    {
        $donorRole = ModelsRole::findByName('donor','api'); // Get the donor role object
    
        $donorUsers = $donorRole->users; // Get users associated with the donor role
    
        return ResponseHelper::success(UserResource::collection($donorUsers));
    }
    public function users()
    {
        $userRole = ModelsRole::findByName('user','api'); // Get the donor role object
    
        $normalUsers = $userRole->users; // Get users associated with the donor role
    
        return ResponseHelper::success(UserResource::collection($normalUsers));
    }
    public function admins()
    {
        $adminRole = ModelsRole::findByName('admin','api'); // Get the donor role object
    
        $admins = $adminRole->users; // Get users associated with the donor role
    
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
