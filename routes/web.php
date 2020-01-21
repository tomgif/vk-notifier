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

Route::get('/', function() {
    return redirect()->route('admin.dashboard');
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('/subscriptions', 'Subscription\SubscriptionController')
        ->middleware('can:manage-subscriptions')
        ->only(['index', 'store', 'update']);

    Route::resource('/users', 'UsersController')
        ->middleware('can:manage-users')
        ->only(['index', 'edit', 'update', 'destroy']);

    Route::get('/mailing', 'MailingController@send');
});
