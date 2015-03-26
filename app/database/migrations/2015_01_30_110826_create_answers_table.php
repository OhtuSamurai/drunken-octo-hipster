<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('answers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('participant_id')->unsigned()->nullable();
			$table->foreign('participant_id')->references('id')->on('users');
			$table->integer('timeidea_id')->unsigned();
			$table->foreign('timeidea_id')->references('id')->on('timeideas');
			$table->enum('sopivuus',array('parhaiten','sopii','eisovi','entieda','eivastattu'));
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
		Schema::drop('answers');
	}

}
