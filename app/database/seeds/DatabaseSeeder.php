<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('TimeideaTableSeeder');
	  $this->command->info('User table seeded!');
		$this->command->info('Timeidea table seeded!');
  }

}
