<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RealEstate\PropertyController;
use App\Http\Controllers\Admin\RealEstateController;
use App\Http\Controllers\Admin\RoleAndPermissionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::group(['middleware' => ['role:Administrator|Super Administrator']], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/home', [DashboardController::class, 'index'])->name('home');
    });

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::prefix('access')->group(function () {
        Route::get('/roles', [RoleAndPermissionController::class, 'roles'])->name('access.roles');
        Route::get('/permissions', [RoleAndPermissionController::class, 'permissions'])->name('access.permissions');
    });

    Route::prefix('real-estate')->group(function () {
        Route::resource('categories', \App\Http\Controllers\RealEstate\CategoryController::class, [
            'as' => 'real-estate'
        ]);

        Route::resource('properties', PropertyController::class, [
            'as' => 'real-estate'
        ]);
    });

    Route::resource('blogs', BlogController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->only(['index', 'store']);
});
