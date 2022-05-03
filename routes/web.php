<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SightController;
use App\Http\Controllers\Api\CityController as ApiCityController;
use App\Http\Controllers\Api\ImageController as ApiImageController;
use App\Http\Controllers\Admin\CityController as AdminCityController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\SightController as AdminSightController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Api\ArticleableController as ApiArticleableController;

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

Auth::routes();

Route::view('/', 'index')->name('index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::view('/trip', 'trip')->name('trip');

    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::view('/', 'admin.index')->name('index');
        Route::resource('/cities', AdminCityController::class)->except(['show']);
        Route::resource('/sights', AdminSightController::class)->except(['show']);
        Route::resource('/articles', AdminArticleController::class)->except(['show']);
        Route::resource('/users', AdminUserController::class)->except(['show']);
    });
});

Route::group(['as' => 'api.', 'prefix' => 'api'], function () {
    Route::get('/cities', [ApiCityController::class, 'index']);
    Route::get('/articleables', [ApiArticleableController::class, 'index']);
    Route::post('/images/store', [ApiImageController::class, 'store']);
});

Route::group(['as' => 'cities.', 'prefix' => 'cities'], function () {
    Route::get('/{city:slug}', [CityController::class, 'index'])->name('index');
});

Route::group(['as' => 'sights.', 'prefix' => 'cities'], function () {
    Route::get('/{city:slug}/{sight:slug}', [SightController::class, 'index'])->name('index');
});
