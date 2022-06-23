<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('mails', function (Blueprint $table) {
      $table->id();
      $table->string('uid');
      $table->string('cc');
      $table->string('mail_number');
      $table->string('subject');
      $table->string('description');
      $table->boolean('is_active');
      $table->string('status');
      $table->string('type');
      $table->string('priority');
      $table->string('klasifikasi');
      $table->string('klasifikasi_masalah');
      $table->integer('created_by');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('mails');
  }
};
