<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mail;
use App\Classes\Response;
use Validator;
use App\Http\Resources\SentResource;
class MailController extends Controller {
  public function create(Request $r) {
    $data = [];

    $validator = Validator::make($r->all(), [
      'subject' => "string|required|min:3|max:255",
      'description' => 'string|required|min:3',
      'type' => 'string|required|min:3'
    ]);

    if (!$validator->fails()) {
      $mail = Mail::create([
        'mail_number' => $r->mail_number,
        'uid' => $r->send_to,
        'subject' => $r->subject,
        'description' => $r->description,
        'created_by' => auth()->user()->id,
        'is_active' => true,
        'status' => MAIL::TERKIRIM,
        'type' => $r->type
      ]);
    } else {
      return response()->json($validator->errors()); 
    }

    return Response::pretty(200, 'Success', 'Data has been created', $mail);
  }

  public function read(Request $r) {
    $mail = Mail::where('id', $r->id)
      ->where('is_active', true)
      ->firstOrFail();

    return Response::pretty(200, 'Success', 'Data available', $mail);
  }

  public function readAll(Request $r) {
    $sortField = [
      'no_surat' => 'mail_number',
      'kepada' => 'uid',
      'perihal' => 'title',
      'tanggal' => 'created_at',
      'jenis_surat' => 'type',
      'status' => 'status',
      'keterangan' => 'description'
    ];

    $orderField = ['asc', 'desc'];
    
    if ($r->order == null || $r->field == null || 
        !in_array($r->field, array_values($sortField)) || !in_array($r->order, $orderField)) {
      $r->order = 'asc';
      $r->field = 'mail_number';
    }

    $query = Mail::where('created_by', auth()->user()->id)
      ->where('is_active', true)
      ->orderBy($r->field, $r->order);

    if (!is_null($r->search)) {
      $query = $query
        ->where('mail_number', 'like', '%'.$r->search.'%')
        ->orWhere('title', 'like', '%'.$r->search.'%');
    }

    return SentResource::collection($query->paginate(10));
  }

  public function readInbox(Request $r) {
    $mails = Mail::where('uid', auth()->user()->id)
      ->where('is_active', true)
      ->get()
      ->toArray();

    if (!empty($mails)) {
      $data = Response::pretty(200, 'Success', 'Data available', $mails);
    } else {
      $data = Response::pretty(404, 'Failed', 'Data not available', null);
    }

    return $data;
  }

  public function update(Request $r) {
    $mail = Mail::where('id', $r->id)
      ->where('is_active', true)
      ->firstOrFail();

    $mail->subject = $r->subject;
    $mail->description = $r->description;
    
    if ($mail->save()) {
      return Response::pretty(200, 'Success', 'Data has been updated', $mail);
    } else {
      return Response::pretty(500, 'Failed', 'Data available', $mail);
    }
  }

  public function delete(Request $r) {
    $mail = Mail::where('id', $r->id)
      ->where('is_active', true)
      ->firstOrFail();

    $mail->is_active = false;
    
    if ($mail->save()) {
      return Response::pretty(200, 'Success', 'Data has been updated', null);
    } else {
      return Response::pretty(500, 'Failed', 'Data available', null);
    }
  }

  public function inbox() {

  }
}
