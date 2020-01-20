<?php

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

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::resource('/subscription', 'Subscription\SubscriptionController')
    ->only(['index', 'store', 'update']);

Route::resource('/admin/users', 'UserController');
