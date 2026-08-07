<?php

use App\Http\Controllers\API\ApiManagementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/seting', [ApiManagementController::class, 'settingdata']);
Route::get('/branding', [ApiManagementController::class, 'getBrands']);
Route::get('/hero/section', [ApiManagementController::class, 'getBanner']);
Route::get('/all/category', [ApiManagementController::class, 'getCategory']);
Route::post('/contact/store', [ApiManagementController::class, 'contactstore']);
Route::get('/all/insight', [ApiManagementController::class, 'allBlogs']);
