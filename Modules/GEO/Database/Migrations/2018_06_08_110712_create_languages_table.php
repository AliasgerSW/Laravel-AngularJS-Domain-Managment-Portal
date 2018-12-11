<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_english',50);
            $table->string('code',2);
            $table->string('name',50);
            $table->string('script_type',50)->nullable();
            $table->string('family',50)->nullable();
            $table->string('type',50)->nullable();
            $table->string('type_iso_code',50)->nullable();
            $table->tinyInteger('is_translate')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
