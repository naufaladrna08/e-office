<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use Illuminate\Http\Request;

class ParameterController extends Controller {
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $data = [];
    
    $model = new Parameter;
    $model->pname = $request->pname;
    $model->pcode = $request->pcode;
    $model->description = $request->description;

    if ($model->save()) {
      $data = Response::pretty(500, "Failed", "Internal Server Error", null);
    } else {
      $data = Response::pretty(200, "Success", "Data has been saved", $model);
    }

    return $data;    
  }
  public function update(Request $r) {
    $data = [];
    
    $model = Paramter::firstOrCreate([
      'pcode' => $r->pcode
    ], [
      'pname' => $r->pname,
      'description' => $r->description
    ]);

    return Response::pretty(200, 'Success', 'Data has been saved', $model);
  }
}
