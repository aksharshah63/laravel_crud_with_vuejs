<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('category',App\Http\Controllers\CategoryController::class)->middleware('auth:api');
Route::get('get_user','App\Http\Controllers\CategoryController@getuser');

Route::post('user_register', [App\Http\Controllers\API\AuthController::class, 'user_register'])->name('user_register');
Route::post('user_login', [App\Http\Controllers\Auth\LoginController::class, 'user_login'])->name('user_login');
