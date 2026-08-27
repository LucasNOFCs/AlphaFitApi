<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MembersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('users', UserController::class);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return response()->json($request->user());
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('plans', [PlansController::class, 'index'])
        ->middleware('permission:plans.view');

    Route::get('plans/{id}', [PlansController::class, 'show'])
        ->middleware('permission:plans.view');

    Route::post('plans', [PlansController::class, 'store'])
        ->middleware('permission:plans.create');

    Route::match(['put', 'patch'], 'plans/{id}', [PlansController::class, 'update'])
        ->middleware('permission:plans.update');

    Route::delete('plans/{id}', [PlansController::class, 'destroy'])
        ->middleware('permission:plans.delete');

});