<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDomainsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('domains', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->enum('registrar', array('OpenSRS','ResellerClub'));
			$table->bigInteger('customer_id');
			$table->string('order_id', 30);
			$table->bigInteger('tld_id');
			$table->string('domain_name', 50);
			$table->string('domian_secret_key', 100);
			$table->date('register_date');
			$table->date('expiry_date');
			$table->date('deleted_date');
			$table->boolean('privacy_protection_status');
			$table->date('privacy_protection_activated_date');
			$table->date('privacy_protection_expiry_date');
			$table->boolean('theft_protection_status');
			$table->date('theft_protection_activated_date');
			$table->date('theft_protection_expiry_date');
			$table->boolean('dns_status');
			$table->date('dns_activated_date');
			$table->date('dns_expiry_date');
			$table->boolean('is_auto_renew');
			$table->enum('domian_status', array('active','inactive','expired','transformed','lock','unlock'));
			$table->string('privacy_protection_reason')->nullable();
            $table->boolean('gdpr_protection')->default(0);
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
		Schema::drop('domains');
	}

}
