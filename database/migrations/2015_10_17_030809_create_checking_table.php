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
            $table->integer('accreditation_id')->unsigned();
            $table->boolean('confirmed');
            $table->dateTime('day_event');
            $table->timestamps();

            $table->foreign('accreditation_id')->references('id')->on('accreditation');
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
