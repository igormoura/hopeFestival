<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('customers', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('document')->unique();
      $table->string('email')->unique();
      $table->string('phone');
      $table->integer('version_id')->unsigned();
      $table->timestamps();

      $table->foreign('version_id')->references('id')->on('versions');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('customers');
  }
}
