<?php

use Illuminate\Database\Migrations\Migration;

class Floors extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('floors', function($table)
        {
            $table->increments('id');
            $table->integer('house_id');
            $table->integer('layout_id');
            $table->integer('floor_no');
            $table->string('title');
            $table->text('svg');

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
        Schema::dropIfExists('floors');
	}

}