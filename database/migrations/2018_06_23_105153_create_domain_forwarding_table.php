<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainForwardingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_forwarding', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('domain_id');
            $table->bigInteger('subdomain_id')->nullable();
            $table->string('source');
            $table->enum('destination_protocol', ['http', 'https']);
            $table->string('destination_url');
            $table->boolean('url_masking');
            $table->text('header_tags')->nullable();
            $table->text('page_content')->nullable();
            $table->boolean('sub_domain_forwarding')->default(0);
            $table->boolean('path_forwarding')->default(0);
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
        Schema::dropIfExists('domain_forwarding');
    }
}
