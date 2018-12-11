<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounriesLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_languages', function (Blueprint $table) {
            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('language_id')->unsigned();
        });

        Schema::table('cities', function (Blueprint $table) {
            //$table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            //$table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_languages');
    }
}
