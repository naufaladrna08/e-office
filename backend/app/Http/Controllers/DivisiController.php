<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Divisi;

class DivisiController extends Controller {
  public function create(Request $r) {
    $validator = Validator::make($r->all(), [
      'code_divisi' => 'required|string|max:8|min:8',
      'nama_divisi' => 'required|string|max:8|min:8'
    ]);

    if (!$validator->fails()) {
      $data = Divisi::create([
        'code_divisi' => $r->code_divisi,
        'nama_divisi' => $r->nama_divisi
      ]);

      if (!$data) {
        return Response::pretty(500, 'Failed', 'Internal Server Error', null);
      }
    } else {
      return Response::pretty(500, 'Failed', 'Internal Server Error', null);
    }

    return Response::pretty(200, 'Success', 'Data has been created', [
      'user' => $user,
      'access_token' => $token,
      'token_type' => 'Bearer'
    ]);
  }

  public function read(Request $r) {
    
  }

  public function update(Request $r) {

  }

  public function delete(Request $r) {
    
  }
}
