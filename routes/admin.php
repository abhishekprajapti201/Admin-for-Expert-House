<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InsightPageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Backend\AdminController;

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

    Route::controller(BannerController::class)->group(function(){
        Route::get('/banner', 'index')->name('banner');
        Route::get('/banner/{id}/edit', 'edit')->name('banner.edit');
        Route::get('/banner/create', 'create')->name('banner.form');
        Route::post('/banner/store', 'store')->name('banner.store');
        Route::post('/banner/{id}/update','update')->name('banner.update');
        Route::delete('/banner/{id}/delete','destroy')->name('banner.delete');
    });

    Route::controller(BrandController::class)->group(function(){
        Route::get('/brand', 'index')->name('brand');
        Route::get('/brand/{id}/edit', 'edit')->name('brand.edit');
        Route::get('/brand/create', 'create')->name('brand.form');
        Route::post('/brand/store', 'store')->name('brand.store');
        Route::post('/brand/{id}/update','update')->name('brand.update');
        Route::delete('/brand/{id}/delete','destroy')->name('insight.delete');
    });
});
