<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTldsFeaturesServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tlds_features_services', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('tld_id');
			$table->float('dns_price', 10, 0)->nullable();
			$table->boolean('is_dns_active')->nullable();
            $table->string('dns_service_type', 20)->nullable();
            $table->string('dns_duration', 20)->nullable();
			$table->float('dns_cost_price', 10, 0)->nullable();
			$table->float('dns_activation_fee', 10, 0)->nullable();

			$table->float('privacy_protection_price', 10, 0)->nullable();
			$table->boolean('is_privacy_protection_active')->nullable();
            $table->string('privacy_protection_service_type', 20)->nullable();
            $table->string('privacy_protection_duration', 20)->nullable();
            $table->float('privacy_protection_cost_price', 10, 0)->nullable();
            $table->float('privacy_protection_activation_fee', 10, 0)->nullable();

			$table->float('theft_protection_price', 10, 0)->nullable();
			$table->boolean('is_theft_protection_active')->nullable();
            $table->string('theft_protection_service_type', 20)->nullable();
            $table->string('theft_protection_duration', 20)->nullable();
            $table->float('theft_protection_cost_price', 10, 0)->nullable();
            $table->float('theft_protection_activation_fee', 10, 0)->nullable();

			$table->float('child_name_server_price', 10, 0)->nullable();
			$table->boolean('is_child_name_server_active')->nullable();
            $table->string('child_name_server_service_type', 20)->nullable();
            $table->string('child_name_server_duration', 20)->nullable();
            $table->float('child_name_server_cost_price', 10, 0)->nullable();
            $table->float('child_name_server_activation_fee', 10, 0)->nullable();

			$table->boolean('is_domain_secret_active')->nullable();
            $table->float('domain_secret_price', 10, 0)->nullable();
            $table->string('domain_secret_service_type', 20)->nullable();
            $table->string('domain_secret_duration', 20)->nullable();
            $table->float('domain_secret_cost_price', 10, 0)->nullable();
            $table->float('domain_secret_activation_fee', 10, 0)->nullable();

			$table->boolean('is_domain_forwarding_active')->nullable();
            $table->float('domain_forwarding_price', 10, 0)->nullable();
            $table->string('domain_forwarding_service_type', 20)->nullable();
            $table->string('domain_forwarding_duration', 20)->nullable();
            $table->float('domain_forwarding_cost_price', 10, 0)->nullable();
            $table->float('domain_forwarding_activation_fee', 10, 0)->nullable();

			$table->boolean('is_name_server_active')->nullable();
            $table->float('name_server_price', 10, 0)->nullable();
            $table->string('name_server_service_type', 20)->nullable();
            $table->string('name_server_duration', 20)->nullable();
            $table->float('name_server_cost_price', 10, 0)->nullable();
            $table->float('name_server_activation_fee', 10, 0)->nullable();

			$table->boolean('min_nameserver_limit')->nullable();
			$table->integer('max_nameserver_limit')->nullable();

			$table->boolean('is_wap_active')->nullable();
            $table->float('wap_price', 10, 0)->nullable();
            $table->string('wap_service_type', 20)->nullable();
            $table->string('wap_duration', 20)->nullable();
            $table->float('wap_cost_price', 10, 0)->nullable();
            $table->float('wap_activation_fee', 10, 0)->nullable();

			$table->boolean('is_chat_active')->nullable();
            $table->float('chat_price', 10, 0)->nullable();
            $table->string('chat_service_type', 20)->nullable();
            $table->string('chat_duration', 20)->nullable();
            $table->float('chat_cost_price', 10, 0)->nullable();
            $table->float('chat_activation_fee', 10, 0)->nullable();

			$table->boolean('is_free_email_active')->nullable();
            $table->float('free_email_price', 10, 0)->nullable();
            $table->string('free_email_service_type', 20)->nullable();
            $table->string('free_email_duration', 20)->nullable();
            $table->float('free_email_cost_price', 10, 0)->nullable();
            $table->float('free_email_activation_fee', 10, 0)->nullable();

            $table->boolean('gdrp_protection_active')->nullable();
            $table->float('gdrp_protection_price', 10, 0)->nullable();
            $table->string('gdrp_protection_service_type', 20)->nullable();
            $table->string('gdrp_protection_duration', 20)->nullable();
            $table->float('gdrp_protection_cost_price', 10, 0)->nullable();
            $table->float('gdrp_protection_activation_fee', 10, 0)->nullable();

            $table->boolean('dnssec_active')->nullable();
            $table->float('dnssec_price', 10, 0)->nullable();
            $table->string('dnssec_service_type', 20)->nullable();
            $table->string('dnssec_duration', 20)->nullable();
            $table->float('dnssec_cost_price', 10, 0)->nullable();
            $table->float('dnssec_activation_fee', 10, 0)->nullable();

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
		Schema::dropIfExists('tlds_features_services');
	}

}
