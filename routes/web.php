<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\PaymentController;

Route::get("/", function () {
    return view("welcome");
});

Route::apiResource("users", UserController::class);
Route::apiResource("members", MembersController::class);
Route::apiResource("plans", PlansController::class);
Route::apiResource("payments", PaymentController::class);
