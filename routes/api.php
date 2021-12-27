<?php

use App\Http\Controllers\Api\V1\RandomESController;
use App\Http\Controllers\Api\V1\RandomSQLController;
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
    Route::get('sql/randomness/search', [ RandomSQLController::class, 'textSearch' ])->name('randomness.textSearch');
    Route::get('es/randomness/search', [ RandomESController::class, 'textSearch' ])->name('randomness.textSearch');
    Route::apiResource('sql/randomness', RandomSQLController::class);
});
