<?php

namespace App\Classes;

class Response {
  public static function pretty($code = 200, $status = '', $message = '', $data = null) {
    $data = [
      'code' => $code,
      'status' => $status,
      'message' => $message,
      'data' => $data
    ];

    return response()->json($data);
  }
};