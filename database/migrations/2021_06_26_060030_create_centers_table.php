<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')
				  ->constrained()
				  ->onDelete('cascade')
				  ->onUpdate('cascade');
			$table->string('name')->nullable();
			$table->longText('address')->nullable();
			$table->longText('block_name')->nullable();
			$table->integer('pincode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centers');
    }
}
