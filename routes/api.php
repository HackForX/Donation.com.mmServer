<?php

use App\Http\Controllers\Api\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Api\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Api\Admin\CityController as AdminCityController;
use App\Http\Controllers\Api\Admin\SubItemController as AdminSubItemController;
use App\Http\Controllers\Api\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Api\Admin\SubCategoryController as AdminSubCategoryController;
use App\Http\Controllers\Api\Admin\TownshipController as AdminTownshipController;
use App\Http\Controllers\Api\Admin\DonorRequestController as AdminDonorRequestController;
use App\Http\Controllers\Api\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Api\Admin\SaduditharController as AdminSaduditharController;
use App\Http\Controllers\Api\Admin\NatebanzayController as AdminNatebanzayController;
use App\Http\Controllers\Api\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Api\Admin\NatebanzayRequestController as AdminNatebanzayRequestController;








use App\Http\Controllers\Api\User\AuthController as UserAuthController;
use App\Http\Controllers\Api\User\TownshipController as UserTownshipController;
use App\Http\Controllers\Api\User\CityController as UserCityController;
use App\Http\Controllers\Api\User\ItemController as UserItemController;
use App\Http\Controllers\Api\User\SubItemController as UserSubItemController;
use App\Http\Controllers\Api\User\CategoryController as UserCategoryController;
use App\Http\Controllers\Api\User\SubCategoryController as UserSubCategoryController;
use App\Http\Controllers\Api\User\DonorRequestController as UserDonorRequestController;
use App\Http\Controllers\Api\User\SaduditharController as UserSaduditharController;
use App\Http\Controllers\Api\User\NatebanzayController as UserNatebanzayController;
use App\Http\Controllers\Api\User\NatebanzayRequestController as UserNatebanzayRequestController;
use App\Http\Controllers\Api\User\NatebanzayChatController as UserNatebanzayChatControlller;
use App\Http\Controllers\Api\User\SaduditharCommentController as UserSaduditharCommentController;
use App\Http\Controllers\Api\User\NatebanzayCommentController as UserNatebanzayCommentController;
use App\Http\Controllers\Api\User\SaduditharLikeController as UserSaduditharLikeController;
use App\Http\Controllers\Api\User\NatebanzayLikeController as UserNatebanzayLikeController;
use App\Http\Controllers\Api\User\SaduditharViewController as UserSaduditharViewController;
use App\Http\Controllers\Api\User\NatebanzayViewController as UserNatebanzayViewController;
use App\Http\Controllers\Api\User\NotificationController as UserNotificationController;
use App\Http\Controllers\Api\User\NatebanzayChatMessageController as UserNatebanzayChatMessageController;
use App\Http\Controllers\Api\User\ContactController as UserContactController;


















use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



//Admin
Route::post('admin/login', [AdminAuthController::class, 'login']);
Route::post('admin/signUp', [AdminAuthController::class, 'register']);


Route::middleware(['auth:api', 'role:admin'])->prefix('admin')->group(function () {
    Route::controller(AdminAuthController::class)->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout']);
        Route::post('/register-donor', [AdminAuthController::class, 'registerDonor']);
    });
    Route::controller(AdminSaduditharController::class)->group(function () {
        Route::get('/sadudithars', [AdminSaduditharController::class, 'index']);
        Route::post('/sadudithars', [AdminSaduditharController::class, 'store']);
        Route::post('/sadudithars/{id}', [AdminSaduditharController::class, 'edit']);
        Route::delete('/sadudithars/{id}', [AdminSaduditharController::class, 'destroy']);
        Route::get('/pending-sadudithars', [AdminSaduditharController::class, 'pendingSadudithars']);
        Route::post('/sadudithar-requests/approve/{id}', [AdminSaduditharController::class, 'approve']);
        Route::post('/sadudithar-requests/refuse/{id}', [AdminSaduditharController::class, 'refuse']);
    });
    Route::controller(AdminNatebanzayController::class)->group(function () {
        Route::get('/admin-natebanzays', [AdminNatebanzayController::class, 'adminNatebanzays']);
        Route::post('/natebanzays', [AdminNatebanzayController::class, 'store']);
        Route::post('/natebanzays/{id}', [AdminNatebanzayController::class, 'edit']);
        Route::delete('/natebanzays/{id}', [AdminNatebanzayController::class, 'destroy']);
        Route::get('/donor-natebanzays', [AdminNatebanzayController::class, 'donorNatebanzays']);
        Route::get('/denied-natebanzays', [AdminNatebanzayController::class, 'deniedNatebanzays']);
        Route::post('/natebanzays/{id}/approve', [AdminNatebanzayController::class, 'approve']);
        Route::post('/natebanzays/{id}/refuse', [AdminNatebanzayController::class, 'refuse']);
    });
    Route::controller(AdminNatebanzayRequestController::class)->group(function () {
        Route::get('/natebanzay/{id}/requests', [AdminNatebanzayRequestController::class, 'index']);
        Route::post('/natebanzay-requests/{id}/accept', [AdminNatebanzayRequestController::class, 'accept']);
        Route::post('/natebanzay-requests/{id}/reject', [AdminNatebanzayRequestController::class, 'reject']);
    });
    Route::controller(UserNatebanzayChatControlller::class)->group(function () {
        Route::get('/natebanzay-chat', [UserNatebanzayChatControlller::class, 'index']);
    });
    Route::controller(UserNatebanzayChatMessageController::class)->group(function () {
        Route::get('/get-messages/{id}', [UserNatebanzayChatMessageController::class, 'index']);
        Route::post('/send-message', [UserNatebanzayChatMessageController::class, 'store']);
    });
    Route::controller(AdminUsersController::class)->group(function () {
        Route::get('/donors', [AdminUsersController::class, 'donors']);
        Route::get('/users', [AdminUsersController::class, 'users']);
        Route::get('/admins', [AdminUsersController::class, 'admins']);
        Route::delete('/users/{id}', [AdminUsersController::class, 'destroy']);
    });
    Route::controller(AdminSubCategoryController::class)->group(function () {
        Route::get('/sub-categories', [AdminSubCategoryController::class, 'index']);
        Route::post('/sub-categories', [AdminSubCategoryController::class, 'store']);
        Route::put('/sub-categories/{id}', [AdminSubCategoryController::class, 'edit']);
        Route::delete('/sub-categories/{id}', [AdminSubCategoryController::class, 'destroy']);
    });
    Route::controller(AdminCategoryController::class)->group(function () {
        Route::get('/categories', [AdminCategoryController::class, 'index']);
        Route::post('/categories', [AdminCategoryController::class, 'store']);
        Route::put('/categories/{id}', [AdminCategoryController::class, 'edit']);
        Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy']);
    });
    Route::controller(AdminItemController::class)->group(function () {
        Route::get('/items', [AdminItemController::class, 'index']);
        Route::post('/items', [AdminItemController::class, 'store']);
        Route::put('/items/{id}', [AdminItemController::class, 'edit']);
        Route::delete('/items/{id}', [AdminItemController::class, 'destroy']);
    });
    Route::controller(AdminNotificationController::class)->group(function () {
        Route::get('/notifications', [AdminNotificationController::class, 'index']);
        Route::post('/notifications', [AdminNotificationController::class, 'store']);
        Route::delete('/notifications/{id}', [AdminNotificationController::class, 'destroy']);
    });



    Route::controller(AdminItemController::class)->group(function () {
        Route::get('/items', [AdminItemController::class, 'index']);
        Route::post('/items', [AdminItemController::class, 'store']);
        Route::put('/items/{id}', [AdminItemController::class, 'edit']);
        Route::delete('/items/{id}', [AdminItemController::class, 'destroy']);
    });
    Route::controller(AdminSubItemController::class)->group(function () {
        Route::get('/sub-items', [AdminSubItemController::class, 'index']);
        Route::post('/sub-items', [AdminSubItemController::class, 'store']);
        Route::put('/sub-items/{id}', [AdminSubItemController::class, 'edit']);
        Route::delete('/sub-items/{id}', [AdminSubItemController::class, 'destroy']);
    });
    Route::controller(AdminCityController::class)->group(function () {
        Route::get('/cities', [AdminCityController::class, 'index']);
        Route::post('/cities', [AdminCityController::class, 'store']);
        Route::put('/cities/{id}', [AdminCityController::class, 'edit']);
        Route::delete('/cities/{id}', [AdminCityController::class, 'destroy']);
    });
    Route::controller(AdminTownshipController::class)->group(function () {
        Route::get('/townships', [AdminTownshipController::class, 'index']);
        Route::post('/townships', [AdminTownshipController::class, 'store']);
        Route::put('/townships/{id}', [AdminTownshipController::class, 'edit']);
        Route::delete('/townships/{id}', [AdminTownshipController::class, 'destroy']);
    });
    Route::controller(AdminDonorRequestController::class)->group(function () {
        Route::get('/donor-requests', [AdminDonorRequestController::class, 'index']);
        Route::post('/donor-requests/approve/{id}', [AdminDonorRequestController::class, 'approve']);
        Route::post('/donor-requests/denie/{id}', [AdminDonorRequestController::class, 'denie']);
        Route::delete('/donor-requests/{id}', [AdminDonorRequestController::class, 'destroy']);
    });
});



//User  
Route::post('user/login', [UserAuthController::class, 'login']);
Route::post('user/register', [UserAuthController::class, 'register']);
Route::post('user/forgot-password', [UserAuthController::class, 'forgotPassword']);
Route::post('user/reset-password', [UserAuthController::class, 'resetPassword']);

Route::get('user/checkExist', [UserAuthController::class, 'userExists']);

Route::post('user/login/{provider}/token', [UserAuthController::class, 'loginWithToken']);
// Route::get('user/login/{provider}/callback', [UserAuthController::class, 'handleProviderCallback']);

Route::middleware(['auth:api', 'role:user|donor',])->prefix('user')->group(function () {
    Route::get('/me', [UserAuthController::class, 'me']);

    Route::controller(UserSaduditharController::class)->group(function () {
        Route::get('/sadudithars', [UserSaduditharController::class, 'index']);
        Route::get('/sadudithars/history', [UserSaduditharController::class, 'history']);

        Route::get('/sadudithars/{id}', [UserSaduditharController::class, 'get']);

        Route::post('/sadudithars', [UserSaduditharController::class, 'store']);
        Route::delete('/sadudithars/{id}', [UserSaduditharController::class, 'store']);
    });
    Route::controller(UserAuthController::class)->group(function () {
        Route::post('/logout', [UserAuthController::class, 'logout']);
    });
    Route::controller(UserTownshipController::class)->group(function () {
        Route::get('/townships/{id}', [UserTownshipController::class, 'index']);
    });
    Route::controller(UserCityController::class)->group(function () {
        Route::get('/cities', [UserCityController::class, 'index']);
    });
    Route::controller(UserCategoryController::class)->group(function () {
        Route::get('/categories', [UserCategoryController::class, 'index']);
    });
    Route::controller(UserSubCategoryController::class)->group(function () {
        Route::get('/sub-categories/{id}', [UserSubCategoryController::class, 'index']);
    });
    Route::controller(UserContactController::class)->group(function () {
        Route::get('/contacts', [UserContactController::class, 'index']);
    });
    Route::controller(UserItemController::class)->group(function () {
        Route::get('/items', [UserItemController::class, 'index']);
    });
    Route::controller(UserSubItemController::class)->group(function () {
        Route::get('/sub-items/{id}', [UserSubItemController::class, 'index']);
    });
    Route::controller(UserDonorRequestController::class)->group(function () {
        Route::post('/request-donor', [UserDonorRequestController::class, 'store']);
    });
    Route::controller(AdminUsersController::class)->group(function () {
        Route::get('/donors', [AdminUsersController::class, 'donors']);
    });
    Route::controller(UserNatebanzayController::class)->group(function () {
        Route::get('/natebanzay', [UserNatebanzayController::class, 'index']);
        Route::get('/natebanzay/{id}', [UserNatebanzayController::class, 'get']);

        Route::get('/natebanzays-requested', [UserNatebanzayController::class, 'natebanzayRequested']);
        Route::get('/natebanzays-requests', [UserNatebanzayController::class, 'natebanzayRequests']);
        Route::post('/request-natebanzay', [UserNatebanzayController::class, 'requestNatebanzay']);
        Route::post('/natebanzay', [UserNatebanzayController::class, 'store']);
        Route::post('/natebanzay/{id}', [UserNatebanzayController::class, 'edit']);
        Route::delete('/natebanzay/{id}', [UserNatebanzayController::class, 'destroy']);
    });
    Route::controller(UserNatebanzayRequestController::class)->group(function () {
        Route::get('/natebanzay/{id}/requests', [UserNatebanzayRequestController::class, 'index']);
        Route::post('/natebanzay-requests/{id}/accept', [UserNatebanzayRequestController::class, 'accept']);
        Route::post('/natebanzay-requests/{id}/reject', [UserNatebanzayRequestController::class, 'reject']);
    });
    Route::controller(UserNatebanzayChatControlller::class)->group(function () {
        Route::get('/natebanzay-chat', [UserNatebanzayChatControlller::class, 'index']);
    });
    Route::controller(UserNatebanzayChatMessageController::class)->group(function () {
        Route::get('/get-messages/{id}', [UserNatebanzayChatMessageController::class, 'index']);
        Route::post('/send-message', [UserNatebanzayChatMessageController::class, 'store']);
    });
    Route::controller(UserSaduditharCommentController::class)->group(function () {
        Route::get('/sadudithar-comments/{id}', [UserSaduditharCommentController::class, 'index']);
        Route::post('/sadudithar-comments', [UserSaduditharCommentController::class, 'store']);
    });
    Route::controller(UserNatebanzayCommentController::class)->group(function () {
        Route::get('/natebanzay-comments/{id}', [UserNatebanzayCommentController::class, 'index']);
        Route::post('/natebanzay-comments', [UserNatebanzayCommentController::class, 'store']);
    });
    Route::controller(UserSaduditharLikeController::class)->group(function () {
        Route::get('/sadudithar-likes/{id}', [UserSaduditharLikeController::class, 'index']);
        Route::post('/sadudithar-likes/{id}', [UserSaduditharLikeController::class, 'store']);
    });
    Route::controller(UserNatebanzayLikeController::class)->group(function () {
        Route::get('/natebanzay-likes/{id}', [UserNatebanzayLikeController::class, 'index']);
        Route::post('/natebanzay-likes/{id}', [UserNatebanzayLikeController::class, 'store']);
    });
    Route::controller(UserSaduditharViewController::class)->group(function () {
        Route::get('/sadudithar-views/{id}', [UserSaduditharViewController::class, 'index']);
        Route::post('/sadudithar-views/{id}', [UserSaduditharViewController::class, 'store']);
    });
    Route::controller(UserNatebanzayViewController::class)->group(function () {
        Route::get('/natebanzay-views/{id}', [UserNatebanzayViewController::class, 'index']);
        Route::post('/natebanzay-views/{id}', [UserNatebanzayViewController::class, 'store']);
    });
    Route::controller(UserNotificationController::class)->group(function () {
        Route::post('/save-token', [UserNotificationController::class, 'saveToken']);
        Route::get('/notifications', [UserNotificationController::class, 'notifications']);
    });
});
