<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\SightController;
use App\Http\Controllers\Admin\CityController as AdminCityController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

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

Route::view('/', 'index')->name('index');

Route::group(['as' => 'cities.', 'prefix' => 'cities'], function () {
    Route::get('/cities/{city:slug?}', [CityController::class, 'index'])->name('index');
});

Route::group(['as' => 'sights.', 'prefix' => 'sights'], function () {
    Route::get('/cities/{city:slug}/{sight:slug}', [SightController::class, 'index'])->name('index');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::view('/', 'admin.index')->name('index');
    Route::resource('/cities', AdminCityController::class);
    Route::resource('/users', AdminUserController::class);
});
