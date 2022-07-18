<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Photo;
use App\Classes\Response;
use Validator;
use Auth;

class NewsController extends Controller {
  public function create(Request $r) {
    $data = [];

    $validator = Validator::make($r->all(), [
      'title' => "string|required|min:3|max:255",
      'description' => 'string|required|min:3',
      'cover' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
    ]);

    if (!$validator->fails()) {
      $name = Auth::id() . '-' . time() . '.' . $r->cover->getClientOriginalExtension();
      $path = $r->file('cover')->storeAs('files', $name);

      $model = new Photo;
      $model->path = $path;
      $model->save();
      
      $news = News::create([
        'title' => $r->title,
        'description' => $r->description,
        'cover' => $path,
        'created_by' => auth()->user()->id,
        'is_active' => true
      ]);
    } else {
      return response()->json($validator->errors()); 
    }

    return Response::pretty(200, 'Success', 'Data has been created', $news);
  }

  public function read(Request $r) {
    $news = News::where('id', $r->id)
      ->where('is_active', true)
      ->firstOrFail();

    return Response::pretty(200, 'Success', 'Data available', $news);
  }

  public function readAll(Request $r) {
    $news = News::where('created_by', auth()->user()->id)
      ->where('is_active', true)
      ->get();

    return Response::pretty(200, 'Success', 'Data available', $news);
  }

  public function update(Request $r) {
    $news = News::where('id', $r->id)
      ->where('is_active', true)
      ->firstOrFail();

    $news->title = $r->title;
    $news->description = $r->description;
    
    if ($news->save()) {
      return Response::pretty(200, 'Success', 'Data has been updated', $news);
    } else {
      return Response::pretty(500, 'Failed', 'Data available', $news);
    }
  }

  public function delete(Request $r) {
    $news = News::where('id', $r->id)
      ->where('is_active', true)
      ->firstOrFail();

    $news->is_active = false;
    
    if ($news->save()) {
      return Response::pretty(200, 'Success', 'Data has been updated', null);
    } else {
      return Response::pretty(500, 'Failed', 'Data available', null);
    }
  }
}
