<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use Illuminate\Http\Request;
use App\Classes\Response;

class ParameterController extends Controller {
  public function storeOrUpdate(Request $r) {
    $data = [];
    
    $model = Parameter::updateOrCreate([
      'type' => $r->type,
      'code' => $r->code
    ], [
      'name' => $r->name == null ? 'v1.0' : $r->name,
      'description' => $r->description
    ]);

    return Response::pretty(200, 'Success', 'Data has been saved', $model);
  }
  
  public function fetch(Request $r) {
    $data = [];
    
    $model = Parameter::where('type', $r->type)->firstOrFail();

    return Response::pretty(200, 'Success', 'Data has been saved', $model);
  }
}
