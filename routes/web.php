<?php

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

//Route::get('/', function () {
//    return view('');
//});

Route::group([
    'namespace' => 'Backend',
    'prefix' => 'admin'
], function (){
    // Trang dashboard - trang chủ admin
    Route::get('/dashboard', 'DashboardController@index')->name('backend.dashboard');
    // Quản lý sản phẩm
    Route::group(['prefix' => 'products'], function(){
        Route::get('/', 'ProductController@index')->name('backend.product.index');
        Route::get('/create', [\App\Http\Controllers\Backend\ProductController::class, 'create'])->name('backend.product.create');
        Route::get('/{id?}/showImages', [\App\Http\Controllers\Backend\ProductController::class, 'showImages'])->name('backend.product.showImages');
        Route::get('/{id?}/productsCategory', [\App\Http\Controllers\Backend\CategoryController::class, 'showProducts'])->name('backend.product.productsCategory');
    });
    //Quản lý người dùng
    Route::group(['prefix' => 'users'], function(){
        Route::get('/', [\App\Http\Controllers\Backend\UserController::class, 'index'])->name('backend.user.index');
        Route::get('/create', [\App\Http\Controllers\Backend\UserController::class, 'create'])->name('backend.user.create');
        Route::get('/test', [\App\Http\Controllers\Backend\UserController::class, 'test'])->name('backend.user.test');
    });
    //Quản lí thể loại
    Route::group(['prefix' => 'categories'], function(){
        Route::get('/', [\App\Http\Controllers\Backend\CategoryController::class, 'index'])->name('backend.categories.index');
        Route::get('/create', [\App\Http\Controllers\Backend\CategoryController::class, 'create'])->name('backend.categories.create');
    });
    //Quản lí tác giả
    Route::group(['prefix' => 'authors'], function(){
//        Route::get('/', [\App\Http\Controllers\Backend\CategoryController::class, 'index'])->name('backend.categories.index');
        Route::get('/{id?}/products', [\App\Http\Controllers\Backend\AuthorController::class, 'showProducts'])->name('backend.authors.showProducts');
    });
});

Route::group([
    'namespace' => 'Frontend',
], function (){
    //Trang trủ website
    Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('frontend.home.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
