<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupMember;
use App\Http\Resources\GroupResource;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller {
  public function index(Request $r) {
    $sortField = [
      'id',
      'name',
    ];

    $orderField = ['asc', 'desc'];
    
    if ($r->order == null || $r->field == null || 
        !in_array($r->field, $sortField) || !in_array($r->order, $orderField)) {
      $r->order = 'asc';
      $r->field = 'name';
    }

    $query = DB::table(DB::raw('groups aa'))
      ->select(
        'aa.*', 
        DB::raw('(SELECT COUNT(*) FROM group_members WHERE group_id=aa.id) AS COUNT')
      );
    
    // if (!is_null($r->search)) {
    //   $query = $query
    //     ->where('name', 'like', '%'.$r->search.'%')
    //     ->orWhere('username', 'like', '%'.$r->search.'%');
    // }

    return GroupResource::collection($query->paginate(10));
  }
}
