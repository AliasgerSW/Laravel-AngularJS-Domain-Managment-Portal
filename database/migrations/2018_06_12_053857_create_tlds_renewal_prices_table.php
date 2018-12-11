<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTldsRenewalPricesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tlds_renewal_prices', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('tld_id');
			$table->boolean('year');
			$table->float('renewal_price', 10, 0);
			$table->float('promo_price', 10, 0);
			$table->dateTime('promo_from');
			$table->dateTime('promo_to');
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
		Schema::drop('tlds_renewal_prices');
	}

}
