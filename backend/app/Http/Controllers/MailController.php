<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mail;
use App\Models\Relation;
use App\Classes\Response;
use Validator;
use App\Http\Resources\SentResource;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\IOFactory;
use File;

class MailController extends Controller {
  public function create(Request $r) {
    $data = [];
    
    /* Receiver */
    foreach ($r->options['send_to'] as $each) {
      $relation = new Relation();
      $relation->type = 'RECEIVER';
      $relation->item = $r->options['mailNumber'];
      $relation->from = auth()->user()->id;
      $relation->to   = $each['uid'];
      $relation->save();
    }

    /* Carbon copy */
    foreach ($r->options['cc'] as $each) {
      $relation = new Relation();
      $relation->type = 'CC';
      $relation->item = $r->options['mailNumber'];
      $relation->from = auth()->user()->id;
      $relation->to   = $each['uid'];
      $relation->save();
    }

    $mail = Mail::create([
      'mail_number' => $r->options['mailNumber'],
      'subject' => $r->options['subject'],
      'description' => $r->description,
      'is_active' => true,
      'status' => MAIL::TERKIRIM,
      'priority' => $r->options['prioritas'],
      'type' => $r->options['jenisSurat'],
      'klasifikasi' => $r->options['klasifikasi'],
      'klasifikasi_masalah' => $r->options['klasifikasiMasalah'],
      'created_by' => auth()->user()->id,
    ]);

    return Response::pretty(200, 'Success', 'Data has been created', $mail);
  }

  public function read(Request $r) {
    $mail = Mail::where('mail_number', $r->id)
      ->where('is_active', true)
      ->firstOrFail();

    return Response::pretty(200, 'Success', 'Data available', $mail);
  }

  public function readAll(Request $r) {
    $sortField = [
      'no_surat' => 'mail_number',
      'kepada' => 'uid',
      'perihal' => 'perihal',
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

    $query = DB::table('mails')
      ->select(
        'mails.mail_number', 
        'mails.uid', 
        DB::raw('mails.subject AS perihal'),
        'mails.created_at',
        'mails.type',
        'mails.status',
        DB::raw("(case when mails.status = 'TERKIRIM' THEN CONCAT('Surat telah diterima oleh ', users.name) ELSE 'NO COMMENT' END) AS description")
      )
      ->where('created_by', auth()->user()->id)
      ->where('is_active', true)
      ->where('uid', '<>', auth()->user()->id)
      ->leftJoin('users', 'users.id', '=', 'mails.uid')
      ->orderBy($r->field, $r->order);

    // $query = Mail::where('created_by', auth()->user()->id)
    //   ->where('is_active', true)
      // ->orderBy($r->field, $r->order);

    if (!is_null($r->search)) {
      $query = $query
        ->where('mail_number', 'like', '%'.$r->search.'%')
        ->orWhere('subject', 'like', '%'.$r->search.'%');
    }

    return SentResource::collection($query->paginate(10));
  }

  public function readInbox(Request $r) {
    $sortField = [
      'no_surat' => 'mail_number',
      'kepada' => 'uid',
      'perihal' => 'perihal',
      'tanggal' => 'created_at',
      'jenis_surat' => 'type',
      'status' => 'status',
      'keterangan' => 'description'
    ];

    $orderField = ['asc', 'desc'];

    $ids = null;
    $relation = Relation::where('to', auth()->user()->id)->get();

    foreach ($relation as $each) {
      $ids[] = $each['item'];
    }

    $query = DB::table('mails')
      ->select(
        'mails.mail_number',
        'mails.created_at',
        'mails.type',
        'mails.status',
        'mails.description',
        DB::raw('mails.subject AS perihal'),
      )
      ->wherein('mail_number', $ids)
      ->where('is_active', true)
      ->orderBy('created_at', 'desc');

    if ($r->order == null || $r->field == null || 
        !in_array($r->field, array_values($sortField)) || !in_array($r->order, $orderField)) {
      $r->order = 'asc';
      $r->field = 'mail_number';

      $query->orderBy($r->field, $r->order);
    }

    if (!is_null($r->search)) {
      $query = $query
        ->where('mail_number', 'like', '%'.$r->search.'%')
        ->orWhere('subject', 'like', '%'.$r->search.'%');
    }

    return SentResource::collection($query->paginate(10));
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

  public function readTemplate(Request $r) {
    $data = [];

    $file  = public_path() . '/templates/template_' . $r->id . '.html';
    $image = asset('/templates/template_' . $r->id . '.png');
    $data = file_get_contents($file);

    return response()->json([
      'data' => $data,
      'image' => $image
    ]);
  }

  public function dropdownUsers(Request $r) {
    $fields = ['code', 'name'];
    $data = [];

    $query = DB::table('users')
      ->select('id', 'name');

    if (!is_null($r->search)) {
      $query = $query->where('name', 'like', '%'.$r->search.'%');
    }

    $dataall = $query->get();

    foreach ($dataall as $val) {
      $data[] = [
        'text' => $val->name,
        'id' => $val->id
      ];
    }

    return response()->json($data);
  }

  public function getReceiverAndCc(Request $r) {
    $datareceiver = DB::table('relations')
      ->where('item', $r->item)
      ->where('type','RECEIVER')
      ->leftJoin('users', 'relations.to', '=', 'users.id')
      ->get();

    $datacc = DB::table('relations')
      ->where('item', $r->item)
      ->where('type','CC')
      ->leftJoin('users', 'relations.to', '=', 'users.id')
      ->get();

    return response()->json([
      'data' => [
        'receiver' => $datareceiver,
        'cc' => $datacc
      ]
    ]);
  }
}
