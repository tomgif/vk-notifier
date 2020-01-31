<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('catch', 'Api\VKCallbackController@catch');
Route::post('upload', 'Api\FileUploadController@uploadFile2VK')->name('api.upload.vk');
Route::get('upload', 'Api\FileUploadController@load')->name('api.load.vk');
Route::delete('upload', 'Api\FileUploadController@deleteFileFromVK')->name('api.delete.vk');
