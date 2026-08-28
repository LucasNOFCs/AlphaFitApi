<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Resources\UserResource;

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login');

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return new UserResource($request->user());
});

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/users', [UserController::class, 'index'])
        ->middleware('permission:users.view');

    Route::get('/users/{id}', [UserController::class, 'show'])
        ->middleware('permission:users.view');

    Route::post('/users', [UserController::class, 'store'])
        ->middleware('permission:users.create');

    Route::put('/users/{id}', [UserController::class, 'update'])
        ->middleware('permission:users.update');

    Route::delete('/users/{id}', [UserController::class, 'destroy'])
        ->middleware('permission:users.delete');

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

    Route::get('members', [MemberController::class, 'index'])
        ->middleware('permission:members.view');

    Route::get('members/{id}', [MemberController::class, 'show'])
        ->middleware('permission:members.view');

    Route::post('members', [MemberController::class, 'store'])
        ->middleware('permission:members.create');

    Route::match(['put', 'patch'], 'members/{id}', [MemberController::class, 'update'])
        ->middleware('permission:members.update');

    Route::delete('members/{id}', [MemberController::class, 'destroy'])
        ->middleware('permission:members.delete');

    Route::post('members/{memberId}/assign-plan', [MemberController::class, 'assignPlan'])
        ->middleware('permission:members.assign-plan');

    Route::get('payments', [PaymentController::class, 'index'])
        ->middleware('permission:payments.view');

    Route::get('payments/{id}', [PaymentController::class, 'show'])
        ->middleware('permission:payments.view');

    Route::post('payments', [PaymentController::class, 'store'])
        ->middleware('permission:payments.create');

    Route::match(['put', 'patch'], 'payments/{id}', [PaymentController::class, 'update'])
        ->middleware('permission:payments.update');

    Route::delete('payments/{id}', [PaymentController::class, 'destroy'])
        ->middleware('permission:payments.delete');
});
