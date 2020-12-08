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
        'namespace' => 'Backend',
        'middleware' => ['auth', 'auth_admin']
    ], function (){
        // Trang dashboard - trang chủ admin
        Route::get('/dashboard', 'DashboardController@index')->name('backend.dashboard');
        Route::get('/test', 'DashboardController@test');
        Route::get('/incompetent', 'DashboardController@incompetent')->name('backend.incompetent');
        // Quản lý sản phẩm
        Route::group(['prefix' => 'products'], function(){
            Route::get('/', 'ProductController@index')->name('backend.product.index');
            Route::get('/get-data', 'ProductController@getData');
            Route::get('/create', [\App\Http\Controllers\Backend\ProductController::class, 'create'])->name('backend.product.create');
            Route::post('/store', [\App\Http\Controllers\Backend\ProductController::class, 'store'])->name('backend.product.store');
            Route::get('/{id?}/edit', 'ProductController@edit')->name('backend.product.edit');
            Route::post('/{id?}/update', 'ProductController@update')->name('backend.product.update');
            Route::delete('/{id}/delete', 'ProductController@destroy')->name('backend.product.destroy');
            Route::delete('/{id}/force-delete', 'ProductController@hardDelete')->name('backend.product.force-delete');
            Route::get('/only-trashed', 'ProductController@onlyTrashed')->name('backend.product.only-trashed');
            Route::get('/{id}/restore', 'ProductController@restore')->name('backend.product.restore');
            Route::get('/{id?}/show', 'ProductController@show')->name('backend.product.show');
        });
        //Quản lý người dùng
        Route::group(['prefix' => 'users'], function(){
            Route::get('/', [\App\Http\Controllers\Backend\UserController::class, 'index'])->name('backend.user.index');
            Route::get('/create', [\App\Http\Controllers\Backend\UserController::class, 'create'])->name('backend.user.create');
            Route::get('/test', [\App\Http\Controllers\Backend\UserController::class, 'test'])->name('backend.user.test');
        });
        //Quản lí thể loại
        Route::group(['prefix' => 'categories'], function(){
            Route::get('/', 'CategoryController@index')->name('backend.category.index');
            Route::get('/create', 'CategoryController@create')->name('backend.category.create');
            Route::post('/store', 'CategoryController@store')->name('backend.category.store');
            Route::get('/{id?}/edit', 'CategoryController@edit')->name('backend.category.edit');
            Route::post('/{id}/update', 'CategoryController@update')->name('backend.category.update');
            Route::delete('/{id}/delete', 'CategoryController@destroy')->name('backend.category.destroy');
            Route::get('/{id}/show', 'CategoryController@show')->name('backend.category.show');
        });
        //Quản lí tác giả
        Route::group(['prefix' => 'authors'], function(){
            Route::get('/', 'AuthorController@index')->name('backend.authors.index');
            Route::get('/create', 'AuthorController@create')->name('backend.authors.create');
            Route::post('/store', 'AuthorController@store')->name('backend.authors.store');
            Route::delete('/{author}/delete', 'AuthorController@destroy')->name('backend.authors.destroy');
        });
        //NXB
        Route::group(['prefix' => 'publishings'], function(){
            Route::get('/', 'PublishingController@index')->name('backend.publishings.index');
            Route::get('/create', 'PublishingController@create')->name('backend.publishings.create');
            Route::post('/store', 'PublishingController@store')->name('backend.publishings.store');
            Route::delete('/{id}/delete', 'PublishingController@destroy')->name('backend.publishings.destroy');
        });
    });
});

Route::group([
    'namespace' => 'Frontend',
], function (){
    //Trang trủ website
    Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('frontend.home.index');
    //Chi tiết sản phẩm
    Route::get('/product-page/{slug}', 'ProductController@show')->name('frontend.product-page.index');
    //Danh sach san pham
    Route::get('/products', 'ProductController@index')->name('frontend.product.index');
    //Giỏ hàng
    Route::get('/cart/list', 'CartController@index')->name('frontend.cart.index');
    Route::get('/cart/add/{id}', 'CartController@add')->name('frontend.cart.add');
    Route::delete('/cart/remove/{id}', 'CartController@remove')->name('frontend.cart.remove');
    Route::put('/cart/update/{id}', 'CartController@update')->name('frontend.cart.remove');
    //Checkout
    Route::get('/checkout', 'CartController@checkout')->name('frontend.checkout');
});
//Order
Route::group([
    'namespace' => 'Backend',
    'prefix' => 'order'
], function () {
    Route::post('/store', 'OrderController@store')->name('frontend.order.store');
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
