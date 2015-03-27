<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLurkersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lurkers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('poll_id')->unsigned();
			$table->foreign('poll_id')->references('id')->on('polls');
			$table->string('name');
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
		Schema::drop('lurkers');
	}

}
