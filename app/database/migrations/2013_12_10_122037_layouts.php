<?php

use Illuminate\Database\Migrations\Migration;

class Layouts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('layouts', function($table)
        {
            $table->increments('id');
            $table->string('type');
            $table->integer('obj_id')->nullable();
            $table->string('title');
            $table->string('schema_image')->nullable();
            $table->text('svg')->nullable();
            $table->integer('album_id')->nullable();

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
        Schema::dropIfExists('layouts');
	}

}