<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\CarController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', [PassportAuthController::class, 'register'])->name('register');
Route::post('login', [PassportAuthController::class, 'login'])->name('login.post');

Route::middleware('auth:api')->group(function () {
    Route::resource('people', PersonController::class);
    Route::resource('cars', CarController::class);
    Route::post('logout', [PassportAuthController::class, 'logout']);
});
