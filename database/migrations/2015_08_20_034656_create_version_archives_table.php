<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVersionArchivesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('version_archives', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('version_id')->unsigned();
      $table->integer('archive_id')->unsigned();
      $table->timestamps();

      $table->foreign('version_id')
        ->references('id')->on('versions')
        ->onDelete('cascade');

      $table->foreign('archive_id')
        ->references('id')->on('archives')
        ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('version_archives');

  }
}
