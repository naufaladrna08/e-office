<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Mail extends Model {
  use HasFactory;

  protected $fillable = [
    'mail_number', 'subject', 'description', 'is_active', 'status', 'type',
    'priority', 'klasifikasi', 'klasifikasi_masalah', 'created_by',
  ];

  /* Status */
  const TERKIRIM = 'TERKIRIM';
  const DISPOSISI = 'DISPOSISI';

  public function getSender() {
    $user = User::where('id', 'created_by')->get();
  }
}
