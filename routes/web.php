<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Payment\CurrencyController;
use App\Http\Controllers\RealEstate\ProjectController;
use App\Http\Controllers\RoleAndPermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Location\CityController;
use App\Http\Controllers\Location\CountryController;
use App\Http\Controllers\Location\StateController;
use App\Http\Controllers\RealEstate\FacilityController;
use App\Http\Controllers\RealEstate\FeatureController;
use App\Http\Controllers\RealEstate\InvestorController;
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
        ])->except(['show']);

        Route::resource('properties', \App\Http\Controllers\RealEstate\PropertyController::class, [
            'as' => 'real-estate'
        ])->except(['show']);

        Route::resource('projects', ProjectController::class, [
            'as' => 'real-estate'
        ])->except(['show']);

        Route::resource('features', FeatureController::class, [
            'as' => 'real-estate'
        ])->except(['create', 'show']);

        Route::resource('facilities', FacilityController::class, [
            'as' => 'real-estate'
        ])->except(['create', 'show']);

        Route::resource('investors', InvestorController::class, [
            'as' => 'real-estate'
        ])->except(['create', 'show']);

    });

    Route::resource('blogs', BlogController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);

    Route::prefix('location')->group(function () {
        Route::resource('countries', CountryController::class, [
            'as' => 'location'
        ])->only(['index', 'store']);
        Route::resource('states', StateController::class, [
            'as' => 'location'
        ])->except(['create', 'show']);
        Route::resource('cities', CityController::class, [
            'as' => 'location'
        ]);
    });

    Route::prefix('payment')->group(function () {
        Route::resource('payment-methods', PaymentMethodController::class, [
            'as' => 'payment'
        ])->except(['show']);
        Route::resource('currencies', CurrencyController::class, [
            'as' => 'payment'
        ])->except(['show']);
    });
});
