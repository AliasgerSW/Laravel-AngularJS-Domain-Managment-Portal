<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDnsARecordsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dns_records', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', array('A','AAAA','MX','CNAME','NS','TXT','SRV  '));
            $table->bigInteger('domain_id');
            $table->bigInteger('record_id')->nullable();
            $table->string('hostname');
            $table->string('value');
            $table->string('host')->nullable();
            $table->boolean('value_type')->default(0);
            $table->boolean('status')->default(0);
            $table->bigInteger('ttl')->nullable();
            $table->string('class')->nullable();
            $table->integer('mx_priority')->default(0);
            $table->integer('weight')->default(0);
            $table->integer('port')->default(0);
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
        Schema::dropIfExists('dns_records');
    }
}
