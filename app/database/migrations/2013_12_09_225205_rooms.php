<?php

use Illuminate\Database\Migrations\Migration;

class Rooms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('rooms', function($table)
        {
            $table->increments('id');
            $table->integer('layout_id');
            $table->integer('title');
            $table->decimal('size_sq', 4, 2);

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
        Schema::dropIfExists('rooms');
    }

}