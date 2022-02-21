<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mail;
use App\Classes\Response;
use Validator;

class MailController extends Controller {
  public function create(Request $r) {
    $data = [];

    $validator = Validator::make($r->all(), [
      'subject' => "string|required|min:3|max:255",
      'description' => 'string|required|min:3'
    ]);

    if (!$validator->fails()) {
      $mail = Mail::create([
        'uid' => $r->send_to,
        'subject' => $r->subject,
        'description' => $r->description,
        'created_by' => auth()->user()->id,
        'is_active' => true
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
    $mails = Mail::where('created_by', auth()->user()->id)
      ->where('is_active', true)
      ->get();

    return Response::pretty(200, 'Success', 'Data available', $mails);
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
}
