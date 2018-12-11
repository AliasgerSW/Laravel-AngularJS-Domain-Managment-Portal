<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContinentTldTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('continent_tld', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('continent_id');
			$table->foreign('continent_id')->references('id')->on('continents')->onDelete('cascade');
			$table->bigInteger('tld_id');
			$table->foreign('tld_id')->references('id')->on('tlds')->onDelete('cascade');
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
		Schema::dropIfExists('continent_tld');
	}

}
