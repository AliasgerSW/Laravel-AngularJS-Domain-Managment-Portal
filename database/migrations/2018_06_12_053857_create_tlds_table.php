<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tlds', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('name', 20);
			$table->smallInteger('sequence');
			$table->enum('feature', array('Popular','Regular'));
			$table->boolean('is_active_for_sale');
			$table->boolean('force_fully_active');
			$table->enum('registrar', array('OpenSRS','ResellerClub'));
            $table->float('cost_price', 10, 0)->nullable();
			$table->boolean('min_purchase_limit')->nullable();
			$table->boolean('max_purchase_limit')->nullable();
			$table->boolean('min_renewal_limit')->nullable();
			$table->boolean('max_renewal_limit')->nullable();
			$table->float('renewal_price')->nullable();
			$table->boolean('max_cancellation_days')->nullable();
			$table->float('cancellation_fees')->nullable();
			$table->integer('min_renewal_time')->nullable();
			$table->integer('grace_period')->nullable();
			$table->integer('restore_period')->nullable();
			$table->float('restore_price', 10, 0)->nullable();
            $table->float('transfer_price', 10, 0)->nullable();
			$table->boolean('bulk_price_limit')->nullable();
			$table->enum('suggest_group', array('none','promo','popular','both'))->default('none');
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
		Schema::dropIfExists('tlds');
	}

}
