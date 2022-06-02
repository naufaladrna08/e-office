<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use Illuminate\Http\Request;
use App\Classes\Response;
use App\Http\Resources\ParameterResource;
use Illuminate\Support\Facades\DB;

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

  public function read(Request $r) {
    $fields = ['code', 'name', 'description'];
    $oderField = ['asc', 'desc'];

    if ($r->order == null || $r->field != null ||
       !in_array($r->order, $oderField) || !in_array($r->field, $fields)) {
      $r->code = 'asc';
      $r->field = 'code';
    }

    $query = DB::table('parameter')
      ->select('code', 'name', 'description')
      ->where('type', 'jenis_surat')
      ->orderBy($r->field, $r->order);

    if (!is_null($r->search)) {
      $query = $query 
        ->where('code', 'like', '%'.$r->search.'%')
        ->orWhere('name', 'like', '%'.$r->search.'%')
        ->orWhere('description', 'like', '%'.$r->search.'%');
    }

    return ParameterResource::collection($query->paginate(10));
  }
}
