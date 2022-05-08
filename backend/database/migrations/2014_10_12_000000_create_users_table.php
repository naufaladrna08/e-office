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
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email')->unique();
      $table->string('username')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->string('code_divisi', 8);
      $table->string('code_jabatan', 8);
      $table->string('last_action');
      $table->integer('profile_photo_id');
      $table->integer('cover_photo_id');
      $table->rememberToken();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users');
  }
};
