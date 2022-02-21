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

Route::middleware('auth:sanctum')->post('/mail/create', [App\Http\Controllers\MailController::class, 'create']);
Route::middleware('auth:sanctum')->get('/mail/read/{id}', [App\Http\Controllers\MailController::class, 'read']);
Route::middleware('auth:sanctum')->get('/mail/read-all', [App\Http\Controllers\MailController::class, 'readAll']);
Route::middleware('auth:sanctum')->post('/mail/update', [App\Http\Controllers\MailController::class, 'update']);
Route::middleware('auth:sanctum')->post('/mail/delete', [App\Http\Controllers\MailController::class, 'delete']);

Route::middleware('auth:sanctum')->post('/news/create', [App\Http\Controllers\NewsController::class, 'create']);
Route::middleware('auth:sanctum')->get('/news/read/{id}', [App\Http\Controllers\NewsController::class, 'read']);
Route::middleware('auth:sanctum')->get('/news/list', [App\Http\Controllers\NewsController::class, 'readAll']);
Route::middleware('auth:sanctum')->post('/news/update', [App\Http\Controllers\NewsController::class, 'update']);
Route::middleware('auth:sanctum')->post('/news/delete', [App\Http\Controllers\NewsController::class, 'delete']);

Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
