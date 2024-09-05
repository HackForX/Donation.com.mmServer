<?php

use App\Http\Controllers\Api\Admin\UsersController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\AuthController as AdminAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/verify-mail/{token}',[AdminAuthController::class,'verificationMail']);
Route::get('/reset-password',[AdminAuthController::class,'resetPasswordLoad']);
Route::post('/reset-password',[AdminAuthController::class,'resetPassword']);



Route::get('/foo', function () {
    Artisan::call('storage:link');
});
