<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\AuthenticationException;

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
  $request->user()->getRoleNames();
  
  return $request->user();
});

Route::group(['prefix' => 'mail', 'middleware' => ['auth:sanctum']], function() {
  Route::post('create', [App\Http\Controllers\MailController::class, 'create']);
  Route::get ('read/{id}', [App\Http\Controllers\MailController::class, 'read']);
  Route::get ('read-all', [App\Http\Controllers\MailController::class, 'readAll']);
  Route::post('update', [App\Http\Controllers\MailController::class, 'update']);
  Route::post('delete', [App\Http\Controllers\MailController::class, 'delete']);
  
  Route::get('sent', [App\Http\Controllers\MailController::class, 'readAll']);
  Route::get('inbox', [App\Http\Controllers\MailController::class, 'readInbox']);
});  

Route::group(['prefix' => 'news', 'middleware' => ['auth:sanctum']], function() {
  Route::post('create', [App\Http\Controllers\NewsController::class, 'create']);
  Route::get ('read/{id}', [App\Http\Controllers\NewsController::class, 'read']);
  Route::get ('list', [App\Http\Controllers\NewsController::class, 'readAll']);
  Route::post('update', [App\Http\Controllers\NewsController::class, 'update']);
  Route::post('delete', [App\Http\Controllers\NewsController::class, 'delete']);
});

Route::group(['prefix' => 'aspiration'], function() {
  Route::post('create', [App\Http\Controllers\AspirationController::class, 'create']);
  Route::get ('list', [App\Http\Controllers\AspirationController::class, 'readAll']);
});

Route::group(['prefix' => 'profile', 'middleware' => 'auth:sanctum'], function() {
  Route::get('list', [App\Http\Controllers\API\AuthController::class, 'index']);
  Route::get('userdata', [App\Http\Controllers\API\AuthController::class, 'userdata']);
  Route::get('user_divisi', [App\Http\Controllers\API\AuthController::class, 'user_divisi']);
  Route::get('user_jabatan', [App\Http\Controllers\API\AuthController::class, 'user_jabatan']);

  Route::post('/create', [App\Http\Controllers\API\AuthController::class, 'register']);
  Route::post('/update', [App\Http\Controllers\API\AuthController::class, 'update']);
  Route::post('/delete', [App\Http\Controllers\API\AuthController::class, 'delete']);
});

Route::group(['prefix' => 'divisi', 'middleware' => 'auth:sanctum'], function() {
  Route::post('create', [App\Http\Controllers\DivisiController::class, 'create']);
  Route::get('read', [App\Http\Controllers\DivisiController::class, 'read']);
  Route::get('dropdown', [App\Http\Controllers\DivisiController::class, 'dropdown']);
  
  Route::post('delete', [App\Http\Controllers\DivisiController::class, 'delete']);
  Route::post('update', [App\Http\Controllers\DivisiController::class, 'update']);
  Route::post('delete', [App\Http\Controllers\DivisiController::class, 'delete']);
  Route::post('user', [App\Http\Controllers\DivisiController::class, 'user']);
});

Route::group(['prefix' => 'jabatan', 'middleware' => 'auth:sanctum'], function() {
  Route::post('create', [App\Http\Controllers\JabatanController::class, 'create']);
  Route::get('read', [App\Http\Controllers\JabatanController::class, 'read']);
  Route::post('update', [App\Http\Controllers\JabatanController::class, 'update']);
  Route::post('delete', [App\Http\Controllers\JabatanController::class, 'delete']);

  Route::get('dropdown', [App\Http\Controllers\JabatanController::class, 'dropdown']);
  Route::post('user', [App\Http\Controllers\JabatanController::class, 'user']);
});

Route::group(['prefix' => 'photo', 'middleware' => 'auth:sanctum'], function() {
  Route::post('store', [App\Http\Controllers\PhotoController::class, 'store']);
});

Route::group(['prefix' => 'parameter'], function() {
  Route::post('store', [App\Http\Controllers\ParameterController::class, 'storeOrUpdate']);
  Route::get('fetch', [App\Http\Controllers\ParameterController::class, 'fetch']);
  Route::get('read', [App\Http\Controllers\ParameterController::class, 'read']);
});

Route::group(['prefix' => 'klasifikasi-masalah', 'middleware' => 'auth:sanctum'], function() {
  Route::post('create', [App\Http\Controllers\KlasifikasiMasalahController::class, 'create']);
  Route::get('read', [App\Http\Controllers\KlasifikasiMasalahController::class, 'read']);
  Route::post('update', [App\Http\Controllers\KlasifikasiMasalahController::class, 'update']);
  Route::post('delete', [App\Http\Controllers\KlasifikasiMasalahController::class, 'delete']);

  Route::get('dropdown', [App\Http\Controllers\KlasifikasiMasalahController::class, 'dropdown']);
  // Route::post('user', [App\Http\Controllers\KlasifikasiMasalahController::class, 'user']);
});

Route::group(['prefix' => 'jenis-surat', 'middleware' => 'auth:sanctum'], function() {
  Route::post('create', [App\Http\Controllers\JenisSuratController::class, 'create']);
  Route::get('read', [App\Http\Controllers\JenisSuratController::class, 'read']);
  Route::post('update', [App\Http\Controllers\JenisSuratController::class, 'update']);
  Route::post('delete', [App\Http\Controllers\JenisSuratController::class, 'delete']);

  Route::get('dropdown', [App\Http\Controllers\JenisSuratController::class, 'dropdown']);
  // Route::post('user', [App\Http\Controllers\JenisSuratController::class, 'user']);
});


Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('/validate-login', [App\Http\Controllers\API\AuthController::class, 'validate_login']);
Route::middleware('auth:sanctum')->post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);