<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('customer_id');
			$table->bigInteger('domain_id');
			$table->enum('type', array('default','technical','admin','billing'));
			$table->string('first_name', 30);
			$table->string('middle_name', 30)->nullable();
			$table->string('last_name', 30);
			$table->string('phone', 15);
            $table->string('phone_code', 15);
            $table->string('fax_code', 15)->nullable();
			$table->string('alternative_tel_num', 15)->nullable();
			$table->string('mobile', 15);
			$table->string('email', 50);
			$table->string('alternative_email', 50)->nullable();
			$table->string('country', 50);
			$table->string('org_name', 50);
			$table->string('state', 50);
			$table->string('city', 50);
			$table->string('address1', 50);
			$table->string('address2', 50)->nullable();
			$table->string('address3', 50)->nullable();
			$table->string('postal_code', 10)->nullable();
			$table->string('fax', 15)->nullable();
			$table->text('notes', 65535)->nullable();
			$table->string('account_holder_position', 50)->nullable();
			$table->string('account_holder_first_name', 30)->nullable();
			$table->string('account_holder_last_name', 30)->nullable();
			$table->timestamps();
			$table->dateTime('deleted_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contacts');
	}

}
