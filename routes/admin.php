<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InsightPageController;
use App\Http\Controllers\Admin\RoomCreateController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\DoctorManageController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Patient\ReportController;
use Illuminate\Support\Facades\Route;

Route::post('/system/login', [AdminController::class, 'systemLogin'])->name('system.login');
Route::prefix('admin')->middleware(['super_admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::controller(SettingsController::class)->group(function () {
        Route::get('/header', 'header')->name('header');
        Route::get('header/{id}', 'edit')->name('header.edit');
        Route::post('/header/update/{id}', 'update')->name('header.update');
        Route::post('/header/store', 'store')->name('header.store');
        Route::delete('/header/delete/{id}', 'destroy')->name('header.delete');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category');
        Route::get('/category/{id}/edit', 'edit')->name('category.edit');
        Route::get('/category/create', 'create')->name('category.form');
        Route::post('/category/store', 'store')->name('category.store');
        Route::post('/category/{id}/update','update')->name('category.update');
        Route::delete('/category/{id}/delete','destroy')->name('category.delete');
    });

    Route::controller(InsightPageController::class)->group(function () {
         Route::get('/insight', 'index')->name('post');
        Route::get('/insight/{id}/edit', 'edit')->name('insight.edit');
        Route::get('/insight/create', 'create')->name('insight.form');
        Route::post('/insight/store', 'store')->name('insight.store');
        Route::post('/insight/{id}/update','update')->name('insight.update');
        Route::delete('/insight/{id}/delete','destroy')->name('insight.delete');
    });
});
