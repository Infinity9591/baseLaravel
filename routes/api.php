<?php

use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::get('/test', function () {
//    return response()->json(['message' => 'API is working!']);
//});

Route::get('/role', [RoleController::class, 'index']);
Route::post('/role/create', [RoleController::class, 'create']);
Route::post('/role/update', [RoleController::class, 'update']);

Route::get('/account', [AccountController::class, 'index']);
Route::post('/account/create', [AccountController::class, 'create']);
Route::post('/account/active', [AccountController::class, 'active']);
Route::post('/account/deactive', [AccountController::class, 'deactive']);
Route::post('/account/editRole', [AccountController::class, 'editRole']);

Route::get('/rolePermission', [RolePermissionController::class, 'index']);
Route::post('/rolePermission/addPermission', [RolePermissionController::class, 'addPermissions']);
Route::post('/rolePermission/deletePermission', [RolePermissionController::class, 'deletePermissions']);

Route::get('/tableLog/getTableLogs', [\App\Http\Controllers\TableLogController::class, 'index']);

Route::get('/user', [\App\Http\Controllers\UserController::class, 'index']);
Route::post('/user/create', [\App\Http\Controllers\UserController::class, 'create']);
Route::post('/user/update', [\App\Http\Controllers\UserController::class, 'update']);

Route::middleware(\App\Http\Middleware\VerifyTokens::class)->group(function () {
    Route::post('/site/login', [\App\Http\Controllers\SiteController::class, 'login']);

});
//Route::post('/site/login', [\App\Http\Controllers\SiteController::class, 'login']);






