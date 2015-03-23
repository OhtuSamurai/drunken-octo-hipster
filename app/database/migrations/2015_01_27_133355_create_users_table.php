<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
   * Creates table users in the database, with
   * columns first_name, last_name, department, position.
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('department');
			$table->string('position');
			$table->string('username')->default("tekaistunimi");
			$table->boolean('is_admin')->default(0);
			$table->boolean('is_active')->default(1);
			$table->text('description')->default('');
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
