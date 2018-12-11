<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDomainDnsRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('domain_dns_records', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('domain_id');
			$table->text('a_record', 65535)->nullable();
			$table->text('aaaa_record', 65535)->nullable();
			$table->text('max_record', 65535)->nullable();
			$table->text('cname_record', 65535)->nullable();
			$table->text('ns_record', 65535)->nullable();
			$table->text('txt_record', 65535)->nullable();
			$table->text('srv_record', 65535)->nullable();
			$table->text('soa_record', 65535)->nullable();
            $table->text('child_ns_record', 65535)->nullable();
            $table->text('dnssec_record', 65535)->nullable();
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
		Schema::drop('domain_dns_records');
	}

}
