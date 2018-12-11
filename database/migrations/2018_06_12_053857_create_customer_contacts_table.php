<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomerContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_contacts', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('resellerclub_client_id', 14);
			$table->string('opensrs_client_id', 14);
			$table->string('client_id', 14);
			$table->string('security_pin', 4);
			$table->enum('type', array('individual','company'));
			$table->string('email', 30);
			$table->text('password', 65535);
			$table->enum('status', array('active','inactive','suspend'));
			$table->string('remeber_token', 100);
			$table->string('company_name', 50);
			$table->string('vat_id', 25);
			$table->string('company_registration_id', 25);
			$table->string('website_url', 200);
			$table->timestamps();
			$table->dateTime('deleted_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('customer_contacts');
	}

}
