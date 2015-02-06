<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPollIdToTimeideaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('timeideas', function(Blueprint $table)
		{
			$table->integer('poll_id')->unsigned();
			$table->foreign('poll_id')->references('id')->on('polls');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('timeideas', function(Blueprint $table)
		{
			$table->dropColumn('poll_id');
		});
	}

}
