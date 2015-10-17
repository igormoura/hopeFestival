<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code_bar_counselor_id')->unsigned();
            $table->boolean('confirmed');
            $table->dateTime('day_event');
            $table->timestamps();

            $table->foreign('code_bar_counselor_id')->references('id')->on('code_bar_counselors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('checking');
    }
}
