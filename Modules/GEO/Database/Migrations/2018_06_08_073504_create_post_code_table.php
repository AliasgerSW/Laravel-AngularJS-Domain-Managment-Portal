<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_code', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('city_id')->unsigned();
            $table->string('code',3);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('post_code', function (Blueprint $table) {
//            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_code');
    }
}
