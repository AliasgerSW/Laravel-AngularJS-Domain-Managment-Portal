<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTldsPricesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tlds_prices', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('tld_id');
			$table->boolean('year');
			$table->float('regular_price', 10, 0);
			$table->float('promo_price', 10, 0);
			$table->dateTime('promo_from');
			$table->dateTime('promo_to');
			$table->float('bulk_price', 10, 0);
			$table->timestamps();
            $table->softDeletes()->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tlds_prices');
	}

}
