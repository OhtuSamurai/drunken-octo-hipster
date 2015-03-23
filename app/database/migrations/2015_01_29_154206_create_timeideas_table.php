<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeideasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('timeideas', function(Blueprint $table)
		{
		$table->increments('id');
		$table->integer('poll_id')->unsigned();
		$table->foreign('poll_id')->references('id')->on('polls');
		$table->string('description');
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
			Schema::drop('timeideas');
	}

}
