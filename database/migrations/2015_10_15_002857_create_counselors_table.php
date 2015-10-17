<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounselorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('counselors', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('email');
        $table->string('area_code');
        $table->string('phone');
        $table->string('phone_cel');
        $table->string('address');
        $table->string('number');
        $table->string('complement');
        $table->string('city');
        $table->string('state');
        $table->string('church');
        $table->string('pastor');
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
      Schema::drop('counselors');
    }
  }
