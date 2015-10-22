<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeBarCounselorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_bar_counselors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code_bar_id')->unsigned();
            $table->integer('counselor_id')->unsigned();
            $table->timestamps();

            $table->foreign('code_bar_id')->references('id')->on('code_bars');
            $table->foreign('counselor_id')->references('id')->on('counselors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('code_bar_counselors');
    }
}
