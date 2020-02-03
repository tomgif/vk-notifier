<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', function() {
    return redirect()->route('admin.dashboard.index');
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('/dashboard', 'DashboardController')
        ->only(['index']);

    Route::resource('/subscriptions', 'SubscriptionController')
        ->middleware('can:manage-subscriptions')
        ->only(['index', 'store', 'update', 'destroy']);

    Route::resource('/users', 'UserController')
        ->middleware('can:manage-users')
        ->only(['index', 'edit', 'update', 'destroy']);

    Route::post('/mailing', 'MailingController@send')
        ->middleware('can:manage-mailing')
        ->name('mailing.send');

    Route::resource('/schedules', 'ScheduleController')
        ->middleware('can:manage-schedules')
        ->except(['show']);
});
