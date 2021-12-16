<?php

use App\Http\Controllers\Api\V1\RegisterController;
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

Route::apiResource('register', RegisterController::class)->only([ 'store' ]);

//TODO All the Routes which require login go here
Route::group([ 'middleware' => [ 'auth.basic.once' ] ], function () {

});
