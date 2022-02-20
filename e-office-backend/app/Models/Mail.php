<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Mail extends Model {
  use HasFactory;

  protected $fillable = [
    'uid',
    'subject',
    'description',
    'is_active',
    'created_by'
  ];

  public function getSender() {
    $user = User::where('id', 'created_by')->get();
  }
}
