<?php

use App\Http\Controllers\PasskeyController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'user'
], function () {

    Route::post('/register', [UserController::class, "register"]);
    Route::post('/login', [UserController::class, "login"]);
    Route::get('/me', [UserController::class, "me"]);
});

Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'passkey'
], function () {

    Route::post('/add', [PasskeyController::class, "create"]);
    Route::get('/getall/{id}', [PasskeyController::class, "getallbyuser"]);
    Route::get('/get/{id}', [PasskeyController::class, "getbyid"]);
    Route::put('/update/{id}', [PasskeyController::class, "update"]);
    Route::get('/delete/{id}', [PasskeyController::class, "detete"]);
});
