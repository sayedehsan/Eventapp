<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIAuthController;
use App\Http\Controllers\EventController;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

Route:: middleware('auth:api')->get('/protected',function(){
    $userId = JWTAuth::parseToken()->getPayload()->get('user_id');
    $user = User::findOrFail($userId);
    return response()->json(['user' => $user], 200);
});

Route::post('auth/register', [ApiAuthController::class, 'register']);
Route::post('auth/login', [ApiAuthController::class, 'login']);

Route::group(['middleware' => 'auth:api', 'prefix' => 'auth'], function () {
    Route::get('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/refresh', [ApiAuthController::class, 'refresh']);
    Route::get('/profile', [ApiAuthController::class, 'userProfile']);
});

Route::group(['middleware'=> 'auth:api'], function () {
    Route::get('/events', [EventController::class, 'index']);
    Route::post('/events', [EventController::class, 'store']);
    Route::get('/events/{id}', [EventController::class, 'show']);
    Route::put('/events/{id}', [EventController::class, 'update']);
    Route::delete('/events/{id}', [EventController::class, 'destroy']);
});