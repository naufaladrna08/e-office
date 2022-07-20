<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Photo;
use App\Classes\Response;
use Illuminate\Routing\UrlGenerator;
use Validator;
use Auth;

class NewsController extends Controller {
  public function create(Request $r) {
    $data = [];

    $validator = Validator::make($r->all(), [
      'title' => "string|required|min:3|max:255",
      'description' => 'string|required|min:3'
    ]);

    if (!$validator->fails()) {
      // return response()->json($r->hasFile('cover'));
      $name = Auth::id() . '-' . time() . '.' . $r->cover->getClientOriginalExtension();
      $path = $r->file('cover')->storeAs('public/files/', $name);

      $model = new Photo;
      $model->path = 'files/' . $name;
      $model->save();
      
      $news = News::create([
        'title' => $r->title,
        'description' => $r->description,
        'cover' => 'files/' . $name,
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

    $news['cover'] = url('storage/' . $news['cover']);

    return Response::pretty(200, 'Success', 'Data available', $news);
  }

  public function readAll(Request $r) {
    $news = News::where('created_by', auth()->user()->id)
      ->where('is_active', true)
      ->get();

    foreach ($news as $each) {
      $description = strip_tags($each['description']);

      if (strlen($description) > 255) {
        $description = substr($description, 0, 255) . ' ...';
      }

      $each['description'] = $description;
    }

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
