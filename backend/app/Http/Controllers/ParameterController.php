<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use Illuminate\Http\Request;
use App\Classes\Response;

class ParameterController extends Controller {
  public function storeOrUpdate(Request $r) {
    $data = [];
    
    $model = Parameter::updateOrCreate([
      'pcode' => $r->pcode
    ], [
      'pname' => $r->pname,
      'description' => $r->description
    ]);

    return Response::pretty(200, 'Success', 'Data has been saved', $model);
  }
  
  public function fetch(Request $r) {
    $data = [];
    
    $model = Parameter::where('pcode', $r->pcode)->firstOrFail();

    return Response::pretty(200, 'Success', 'Data has been saved', $model);
  }
}
