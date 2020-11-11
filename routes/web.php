<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
//use Illuminate\Support\Facades\Auth;

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

//Route::get('/', function () {
//    return view('');
//});

Route::group([
    'prefix' => 'admin'
], function (){
    Route::group([
        'namespace' => 'Backend'
    ], function (){
        // Trang dashboard - trang chủ admin
        Route::get('/dashboard', 'DashboardController@index')->name('backend.dashboard')->middleware('auth');
        Route::get('/test', 'DashboardController@test');
        // Quản lý sản phẩm
        Route::group(['prefix' => 'products'], function(){
            Route::get('/', 'ProductController@index')->name('backend.product.index')->middleware('auth');
            Route::get('/create', [\App\Http\Controllers\Backend\ProductController::class, 'create'])->name('backend.product.create')->middleware('auth');
            Route::post('/store', [\App\Http\Controllers\Backend\ProductController::class, 'store'])->name('backend.product.store')->middleware('auth');
            Route::get('/{id?}/showImages', [\App\Http\Controllers\Backend\ProductController::class, 'showImages'])->name('backend.product.showImages')->middleware('auth');
            Route::get('/{id?}/productsCategory', [\App\Http\Controllers\Backend\CategoryController::class, 'showProducts'])->name('backend.product.productsCategory')->middleware('auth');
            Route::get('/{id?}/edit', 'ProductController@edit')->name('backend.product.edit')->middleware('auth');
            Route::post('/{id?}/update', 'ProductController@update')->name('backend.product.update')->middleware('auth');
        });
        //Quản lý người dùng
        Route::group(['prefix' => 'users'], function(){
            Route::get('/', [\App\Http\Controllers\Backend\UserController::class, 'index'])->name('backend.user.index')->middleware('auth');
            Route::get('/create', [\App\Http\Controllers\Backend\UserController::class, 'create'])->name('backend.user.create')->middleware('auth');
            Route::get('/test', [\App\Http\Controllers\Backend\UserController::class, 'test'])->name('backend.user.test')->middleware('auth');
        });
        //Quản lí thể loại
        Route::group(['prefix' => 'categories'], function(){
            Route::get('/', 'CategoryController@index')->name('backend.category.index')->middleware('auth');
            Route::get('/create', 'CategoryController@create')->name('backend.category.create')->middleware('auth');
            Route::post('/store', 'CategoryController@store')->name('backend.category.store')->middleware('auth');
            Route::get('/{id?}/edit', 'CategoryController@edit')->name('backend.category.edit')->middleware('auth');
            Route::post('/{id}/update', 'CategoryController@update')->name('backend.category.update')->middleware('auth');
        });
        //Quản lí tác giả
        Route::group(['prefix' => 'authors'], function(){
//        Route::get('/', [\App\Http\Controllers\Backend\CategoryController::class, 'index'])->name('backend.categories.index')->middleware('auth');
            Route::get('/{id?}/products', [\App\Http\Controllers\Backend\AuthorController::class, 'showProducts'])->name('backend.authors.showProducts')->middleware('auth');
        });
    });
});

Route::group([
    'namespace' => 'Frontend',
], function (){
    //Trang trủ website
    Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('frontend.home.index');
});

//Auth::routes();
Route::post('/register', 'Auth\RegisterCotroller@showRegistrationForm')->name('register.form');
Route::get('/home', 'HomeController@index')->name('home');
Route::group([
    'namespace' => 'Auth'
], function (){
    Route::get('/login', 'LoginController@showLoginForm')->name('login.form');
    Route::post('/login', 'LoginController@login')->name('login.store');
    Route::post('/logout', 'LoginController@logout')->name('logout');
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('register.form');
    Route::post('/register', 'RegisterController@register')->name('register.store');
});
