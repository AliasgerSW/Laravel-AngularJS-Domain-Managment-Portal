<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 50);
            $table->string('middle_name', 50)->nulable();
            $table->string('last_name', 50);
            $table->enum('gender', ['M', 'F', 'O'])->nullable();
            $table->string('email', 50);
            $table->string('password', 255);
            $table->string('p_email', 50)->nullable();
            $table->tinyInteger('user_level');

            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('city_id');

            $table->string('zipcode', 10);

            $table->string('address1', 50);
            $table->string('address2', 50)->nullable();
            $table->string('address3', 50)->nullable();

            $table->string('phone1', 20)->default('');
            $table->string('phone2', 20)->nullable();

            $table->integer('address_proof_id')->default(0);
            $table->string('document')->nullable();

            $table->string('address_proof_number', 500)->default('');

            $table->string('username', 500);

            $table->integer('shift_timings')->default(0);

            $table->string('profile_image', 200)->default('');
            $table->string('display_name', 30)->default('');

            $table->string('interest', 500)->nullable();
            $table->string('skills', 500)->nullable();
            $table->string('language', 200)->nullable();
            $table->text('about_me')->nullable();
            $table->bigInteger('created_by')->default(0);
            $table->bigInteger('staff_position_id')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('staff_type', ['P', 'T'])->default('P');
            $table->dateTime('expired_on')->nullable();

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
        Schema::dropIfExists('staff');
    }
}
