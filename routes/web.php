<?php

use App\Http\Controllers\JointTripController;
use App\Http\Controllers\JointTripIndexController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\SightController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Api\CityController as ApiCityController;
use App\Http\Controllers\Api\CarouselCityController as ApiCarouselCityController;
use App\Http\Controllers\Api\CarouselSightController as ApiCarouselSightController;
use App\Http\Controllers\Api\ImageController as ApiImageController;
use App\Http\Controllers\Admin\CityController as AdminCityController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ImageController as AdminImageController;
use App\Http\Controllers\Admin\SightController as AdminSightController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;

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

    Route::match(['get', 'post'], '/account', [AccountController::class, 'index'])->name('account');
    Route::match(['get', 'post'], '/account/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/account/trip', [AccountController::class, 'trip'])->name('account.trip');
    Route::match(['get', 'post'], '/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::match(['get', 'post'], '/driver', [DriverController::class, 'store'])->name('driver.store');

    Route::get('/trip', [TripController::class, 'index'])->name('trip');
    Route::post('/joint-trip', [JointTripIndexController::class, 'index'])->name('joint-trip');
    Route::resource('/joint', JointTripController::class);
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::get('/', function () {
            return redirect()->route('admin.cities.index');
        })->name('index');
        Route::resource('/cities', AdminCityController::class)->except(['show']);
        Route::resource('/sights', AdminSightController::class)->except(['show']);
        Route::resource('/articles', AdminArticleController::class)->except(['show']);
        Route::resource('/images', AdminImageController::class)->except(['show', 'edit', 'update']);
        Route::resource('/users', AdminUserController::class)->except(['show']);
        Route::resource('/comments', AdminCommentController::class)->only(['index', 'destroy']);
    });
});

Route::group(['as' => 'api.', 'prefix' => 'api'], function () {
    Route::get('/cities', [ApiCityController::class, 'index']);
    Route::get('/cityList', [ApiCityController::class, 'cityList']);
    Route::get('/carousel/City/{id}', [ApiCarouselCityController::class, 'index']);
    Route::get('/carousel/Sight/{id}', [ApiCarouselSightController::class, 'index']);
    Route::post('/images/store', [ApiImageController::class, 'store'])->name('images.store');
});

Route::group(['as' => 'cities.', 'prefix' => 'cities'], function () {
    Route::get('/{city:slug}', [CityController::class, 'index'])->name('index');
});

Route::group(['as' => 'sights.', 'prefix' => 'cities'], function () {
    Route::get('/{city:slug}/{sight:slug}', [SightController::class, 'index'])->name('index');
});
