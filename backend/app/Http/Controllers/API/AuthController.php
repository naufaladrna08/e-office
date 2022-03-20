<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;
use App\Classes\Response;

class AuthController extends Controller {
  public function register(Request $r) {
    $validator = Validator::make($r->all(), [
      'name' => 'required|string|max:255|min:3',
      'email' => 'required|email|string|max:255|unique:users',
      'username' => 'required|min:3|string|max:255|unique:users',
      'password' => 'required|string|max:255|min:3'
    ]);

    if (!$validator->fails()) {
      $user = User::create([
        'id' => $r->nipp,
        'name' => $r->name,
        'password' => Hash::make($r->password),
        'email' => $r->email,
        'username' => $r->username
      ]);

      $token = $user->createToken('auth_token')->plainTextToken;
      $user->assignRole('user');

    } else {
      return response()->json($validator->errors()); 
    }

    return Response::pretty(200, 'Success', 'Data has been created', [
      'user' => $user,
      'access_token' => $token,
      'token_type' => 'Bearer'
    ]);
  }

  public function login(Request $r) {
    $data = [];
    $credentials = null;

    if (is_numeric($r->username)) {
      $credentials = $r->only('id', 'password');
      $user = User::where('id', $r->username)->first();
    } else {
      $credentials = $r->only('username', 'password');
      $user = User::where('username', $r->username)->first();
    }

    if (!Auth::attempt($credentials)) {
      return Response::pretty(404, 'Failed', 'Data tidak ditemukan', null);
    }
    
    if ($user) {
      $token = $user->createToken('auth_token')->plainTextToken;
      
      $data = response()->json([
        'code' => 200,
        'access_token' => $token,
        'token_type' => 'Bearer',
      ]);
    } else {
      $data = Response::pretty(404, 'Failed', 'Data tidak ditemukan', null);
    }

    return $data;
  }

  public function validate_login(Request $r) {
    $data = [];
    $credentials = null;

    if (is_numeric($r->username)) {
      $credentials = $r->only('id', 'password');
      $user = User::where('id', $r->username)->first();
    } else {
      $credentials = $r->only('username', 'password');
      $user = User::where('username', $r->username)->first();
    }

    if (!Auth::attempt($credentials)) {
      return Response::pretty(404, 'Failed', 'Data tidak ditemukan', null);
    }

    if ($user) {
      $data = response()->json([
        'code' => 200
      ]);
    } else {
      $data = Response::pretty(404, 'Failed', 'Data tidak ditemukan', null);
    }

    return $data;
  }

  public function logout(Request $r) {
    if ($r->user()) {
      $r->user()->tokens()->delete();
    }

    return Response::pretty(200, 'Success', 'You are logged out');
  }
}
