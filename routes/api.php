<?php

use App\Http\Controllers\RolesController;
use App\Http\Controllers\AccountsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::get('/test', function () {
//    return response()->json(['message' => 'API is working!']);
//});

Route::get('/roles', [RolesController::class, 'index']);
Route::post('/roles/create', [RolesController::class, 'create']);
Route::post('/roles/update', [RolesController::class, 'update']);
Route::get('/accounts', [AccountsController::class, 'index']);
