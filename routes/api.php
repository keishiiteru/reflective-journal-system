<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EntryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('entries', EntryController::class)->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login']);
Route::post('logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');
