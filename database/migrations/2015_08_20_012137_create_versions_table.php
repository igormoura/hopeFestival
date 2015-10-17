<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVersionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('versions', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->float('number');
      $table->integer('application_id')->unsigned();
      $table->timestamps();

      $table->foreign('application_id')->references('id')->on('applications');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('versions');
  }
}
