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
  return auth()->user();
});

Route::group(['prefix' => 'mail', 'middleware' => 'auth:sanctum'], function() {
  Route::post('create', [App\Http\Controllers\MailController::class, 'create']);
  Route::get ('read/{id}', [App\Http\Controllers\MailController::class, 'read']);
  Route::get ('read-all', [App\Http\Controllers\MailController::class, 'readAll']);
  Route::post('update', [App\Http\Controllers\MailController::class, 'update']);
  Route::post('delete', [App\Http\Controllers\MailController::class, 'delete']);
});

Route::group(['prefix' => 'news', 'middleware' => 'auth:sanctum'], function() {
  Route::post('create', [App\Http\Controllers\NewsController::class, 'create']);
  Route::get ('read/{id}', [App\Http\Controllers\NewsController::class, 'read']);
  Route::get ('list', [App\Http\Controllers\NewsController::class, 'readAll']);
  Route::post('update', [App\Http\Controllers\NewsController::class, 'update']);
  Route::post('delete', [App\Http\Controllers\NewsController::class, 'delete']);
});

Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
