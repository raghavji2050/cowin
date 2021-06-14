<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
			$table->foreignId('district_id')
				  ->constrained()
				  ->onDelete('cascade')
				  ->onUpdate('cascade');
			$table->integer('center_id');
			$table->string('name')->nullable();
			$table->longText('address')->nullable();
			$table->string('state_name')->nullable();
			$table->longText('district_name')->nullable();
			$table->longText('block_name')->nullable();
			$table->integer('pincode')->nullable();
			$table->string('from')->nullable();
			$table->string('to')->nullable();
			$table->string('lat')->nullable();
			$table->string('long')->nullable();
			$table->string('fee_type')->nullable();
			$table->uuid('session_id')->nullable();
			$table->string('date')->nullable();
			$table->integer('available_capacity')->nullable();
			$table->integer('available_capacity_dose1')->nullable();
			$table->integer('available_capacity_dose2')->nullable();
			$table->decimal('fee')->nullable();
			$table->integer('min_age_limit')->nullable();
			$table->string('vaccines')->nullable();
			$table->longText('slots')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
