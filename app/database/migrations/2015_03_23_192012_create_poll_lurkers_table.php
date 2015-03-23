<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollLurkersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('poll_lurkers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('lurker_id')->unsigned();
			$table->foreign('lurker_id')->references('id')->on('users');
			$table->integer('poll_id')->unsigned();
			$table->foreign('poll_id')->references('id')->on('polls');
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
		Schema::drop('poll_lurkers');
	}

}
