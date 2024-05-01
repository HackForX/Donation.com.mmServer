<?php

use App\Http\Controllers\Api\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Api\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Api\Admin\CityController as AdminCityController;
use App\Http\Controllers\Api\Admin\SubItemController as AdminSubItemController;
use App\Http\Controllers\Api\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Api\Admin\SubCategoryController as AdminSubCategoryController;
use App\Http\Controllers\Api\Admin\TownshipController as AdminTownshipController;
use App\Http\Controllers\Api\Admin\DonorRequestController as AdminDonorRequestController;
use App\Http\Controllers\Api\Admin\DonorsController as AdminDonorsController;
use App\Http\Controllers\Api\Admin\SaduditharController as AdminSaduditharController;
use App\Http\Controllers\Api\Admin\NatebanzayController as AdminNatebanzayController;






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
use App\Http\Controllers\Api\User\SaduditharCommentController as UserSaduditharCommentController;
use App\Http\Controllers\Api\User\SaduditharLikeController as UserSaduditharLikeController;
use App\Http\Controllers\Api\User\SaduditharViewController as UserSaduditharViewController;













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
    Route::controller(AdminSaduditharController::class)->group(function () {
        Route::get('/sadudithars', [AdminSaduditharController::class, 'index']);
        Route::post('/sadudithars', [AdminSaduditharController::class, 'store']);
        Route::put('/sadudithars/{id}', [AdminSaduditharController::class, 'edit']);
        Route::delete('/sadudithars/{id}', [AdminSaduditharController::class, 'destroy']);
    });
    Route::controller(AdminNatebanzayController::class)->group(function () {
        Route::get('/natebanzay-requests', [AdminNatebanzayController::class, 'index']);
        Route::post('/natebanzay-requests', [AdminNatebanzayController::class, 'store']);

        Route::post('/natebanzay-requests/approve/{id}', [AdminSaduditharController::class, 'approve']);
        Route::post('/natebanzay-requests/refuse/{id}', [AdminSaduditharController::class, 'refuse']);
    });
    Route::controller(AdminDonorsController::class)->group(function () {
        Route::get('/donors', [AdminDonorsController::class, 'donors']);
        Route::get('/users', [AdminDonorsController::class, 'users']);
        Route::get('/admins', [AdminDonorsController::class, 'admins']);
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
        Route::put('/approve-request', [AdminDonorRequestController::class, 'approve']);
    });
});



//User  
Route::post('user/login', [UserAuthController::class, 'login']);
Route::post('user/register', [UserAuthController::class, 'register']);

Route::middleware(['auth:api', 'role:user'])->prefix('user')->group(function () {
    Route::controller(UserSaduditharController::class)->group(function () {
        Route::get('/sadudithars', [UserSaduditharController::class, 'index']);
        Route::post('/sadudithars', [UserSaduditharController::class, 'store']);
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
    Route::controller(UserItemController::class)->group(function () {
        Route::get('/items', [UserItemController::class, 'index']);
    });
    Route::controller(UserSubItemController::class)->group(function () {
        Route::get('/sub-items/{id}', [UserSubItemController::class, 'index']);
    });
    Route::controller(UserDonorRequestController::class)->group(function () {
        Route::post('/request-donor', [UserDonorRequestController::class, 'store']);
    });
    Route::controller(AdminDonorsController::class)->group(function () {
        Route::get('/donors', [AdminDonorsController::class, 'donors']);
    });
    Route::controller(UserNatebanzayController::class)->group(function () {
        Route::get('/natebanzay', [UserNatebanzayController::class, 'index']);
        Route::get('/natebanzays-requested', [UserNatebanzayController::class, 'natebanzayRequested']);
        Route::get('/natebanzays-requests', [UserNatebanzayController::class, 'natebanzayRequests']);
        Route::post('/request-natebanzay', [UserNatebanzayController::class, 'requestNatebanzay']);
        Route::post('/natebanzay', [UserNatebanzayController::class, 'store']);
    });
    Route::controller(UserSaduditharCommentController::class)->group(function () {
        Route::get('/sadudithar-comments/{id}', [UserSaduditharCommentController::class, 'index']);
        Route::post('/sadudithar-comments', [UserSaduditharCommentController::class, 'store']);
    });
    Route::controller(UserSaduditharLikeController::class)->group(function () {
        Route::get('/sadudithar-likes/{id}', [UserSaduditharLikeController::class, 'index']);
        Route::post('/sadudithar-likes/{id}', [UserSaduditharLikeController::class, 'store']);
    });
    Route::controller(UserSaduditharViewController::class)->group(function () {
        Route::get('/sadudithar-views/{id}', [UserSaduditharViewController::class, 'index']);
        Route::post('/sadudithar-views/{id}', [UserSaduditharViewController::class, 'store']);
    });
});
