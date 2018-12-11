<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryTldTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_tld', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('tld_group_id');
			$table->foreign('tld_group_id')->references('id')->on('tld_groups')->onDelete('cascade');
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
		Schema::dropIfExists('category_tld');
	}

}
