<?php

use Illuminate\Database\Migrations\Migration;

class Apartments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('apartments', function($table)
        {
            $table->increments('id');
            $table->integer('floor_id');
            $table->integer('layout_id');
            $table->integer('apartment_no');
            $table->string('title');
            $table->string('direction');
            $table->integer('no_rooms');
            $table->integer('status');
            $table->decimal('price_per_sq', 6, 2);
            $table->decimal('price', 6, 2);

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
        Schema::dropIfExists('apartments');
    }


}