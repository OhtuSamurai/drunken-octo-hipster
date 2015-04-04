<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attachment_user', function(Blueprint $table) {
			$table->increments('id');				
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->integer('attachment_id')->unsigned();
			$table->foreign('attachment_id')->references('id')->on('attachments');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attachment_user');
	}

}
