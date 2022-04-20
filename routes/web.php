<?php

use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\SightController;
use App\Http\Controllers\Admin\CityController as AdminCityController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\SightController as AdminSightController;

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

Route::group(['as' => 'api.', 'prefix' => 'api'], function () {
    Route::get('/cities', [HomeController::class, 'index'])->name('index');
});

Route::group(['as' => 'cities.', 'prefix' => 'cities'], function () {
    Route::get('/{city:slug}', [CityController::class, 'index'])->name('index');
});

Route::group(['as' => 'sights.'], function () {
    Route::get('/cities/{city:slug}/{sight:slug}', [SightController::class, 'index'])->name('index');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::view('/', 'admin.index')->name('index');
    Route::resource('/cities', AdminCityController::class);
    Route::resource('/sights', AdminSightController::class);
    Route::resource('/users', AdminUserController::class);
});


// роуты для теста wysiwyg-редактора summernote при создании статьи

Route::group([
    'as' => 'admin::test::',
    'prefix' => '/admin/test'
], function () {
    Route::get( '/',[TestController::class, 'index'])
        ->name('index');

    Route::get('/create',[TestController::class, 'create'])
        ->name('create');

    Route::post( '/save',[TestController::class, 'save'])
        ->name('save');

    Route::get('/update/{article}',[TestController::class, 'update'])
        ->where('article', '[0-9]+')
        ->name('update');

    Route::get('/delete/{id}',[TestController::class, 'delete'])
        ->where('id', '[0-9]+')
        ->name('delete');
});
// ****************************************************
