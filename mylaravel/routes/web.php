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

Route::get('/', 'home\ProductController@index')->name('home');
Route::get('/danh-muc/{slug}','Home\CategoryController@index')->name('home.category.get');
Route::get('/san-pham/{slug}','Home\ProductController@detail')->name('home.product.detail');

Route::get('/dang-nhap', 'Home\AuthController@login')->name('home.login');
Route::post('/dang-nhap', 'Home\AuthController@postLogin')->name('home.login.post');
Route::get('/dang-xuat', 'Home\AuthController@logout')->name('home.logout');

Route::get('/dang-ki', 'Home\AuthController@register')->name('home.register');
Route::post('/dang-ki', 'Home\AuthController@postRegister')->name('home.register.post');

Route::match(['get','post'],'/them-gio-hang/{id}','Home\CartController@addCart')->name('home.cart.add');
Route::get('/xoa-san-pham/{id}', 'Home\CartController@delete')->name('home.cart.delete');

Route::get('/gio-hang', 'Home\CartController@index')->name('home.cart');
Route::get('/xoa-tat-ca-san-pham', 'Home\CartController@deleteAll')->name('home.cart.deleteAll');
Route::post('/cap-nhat-gio-hang', 'Home\CartController@updateCart')->name('home.cart.update');

Route::get('/thanh-toan', 'Home\CartController@checkout')->name('home.checkout');
Route::post('/thanh-toan', 'Home\CartController@addCheckout')->name('home.checkout.post');


Route::group(['middleware' => 'is_admin'], function () {
    Route::get('/admin', 'admin\DashboardController@index')->name('admin');

    Route::get('/category', 'admin\CategorysController@index')->name('auth.category');
    Route::get('/category/add', 'admin\CategorysController@create')->name('auth.category.create');
    Route::post('/category/add', 'admin\CategorysController@store')->name('auth.category.create.post');
    Route::get('/category/{id}', 'admin\CategorysController@detail')->name('auth.category.detail');
    Route::post('/category/{id}', 'admin\CategorysController@update')->name('auth.category.update');
    Route::post('/category/delete{id}', 'admin\CategorysController@delete')->name('auth.category.delete');

    Route::get('/users', 'admin\UsersController@index')->name('admin.users');
    Route::get('/users/search', 'admin\UsersController@search')->name('admin.users.search');

    Route::get('/users/add', 'admin\UsersController@create')->name('admin.users.create');
    Route::post('/users/add', 'admin\UsersController@store')->name('admin.users.create.post');
    Route::get('/users/edit/{id}', 'admin\UsersController@detail')->name('admin.users.edit');
    Route::post('/users/edit/{id}', 'admin\UsersController@update')->name('admin.users.update');
    Route::post('/users/delete/{id}', 'admin\UsersController@delete')->name('admin.users.delete');

    Route::get('/customers', 'admin\CustomersController@index')->name('admin.customers');
    Route::get('/customers/search', 'admin\CustomersController@search')->name('admin.customers.search');
    Route::post('/customers/delete/{id}', 'admin\CustomersController@delete')->name('admin.customers.delete');

    Route::get('/products', 'admin\ProductsController@index')->name('admin.products');
    Route::get('/products/search', 'admin\ProductsController@search')->name('admin.products.search');
    Route::get('/products/add', 'admin\ProductsController@add')->name('admin.products.add');
    Route::post('/products/add', 'admin\ProductsController@store')->name('admin.products.add.post');
    Route::get('/products/edit/{id}', 'admin\ProductsController@detail')->name('admin.products.edit');
    Route::post('/products/edit/{id}', 'admin\ProductsController@update')->name('admin.products.edit.post');
    Route::post('/products/delete/{id}', 'admin\ProductsController@delete')->name('admin.products.delete');

    Route::get('/orders', 'admin\OdersController@index')->name('admin.orders');
    Route::get('/orders/search', 'admin\OdersController@search')->name('admin.orders.search');
    Route::get('/orders/confirm/{id}', 'admin\OdersController@confirm')->name('admin.orders.confirm');
    Route::get('/orders/confirm2/{id}', 'admin\OdersController@confirm2')->name('admin.orders.confirm2');

    Route::get('/orders/detail/{id}', 'admin\OdersController@detail')->name('admin.orders.detail');
});


Route::get('/login', 'admin\AuthController@index')->name('auth.login.get');
Route::post('/login', 'admin\AuthController@postLogin')->name('auth.login.post');
Route::get('/logout', 'admin\AuthController@logout')->name('auth.logout.get');
