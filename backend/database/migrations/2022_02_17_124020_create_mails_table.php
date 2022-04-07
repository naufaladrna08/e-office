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
      $table->integer('uid');
      $table->string('mail_number');
      $table->string('subject');
      $table->string('description');
      $table->boolean('is_active');
      $table->integer('created_by');
      $table->string('status');
      $table->string('type');
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
