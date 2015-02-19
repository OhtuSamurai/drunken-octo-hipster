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
	  	$this->command->info('User table seeded!');

	  	$this->call('CommitteeTableSeeder');
	  	$this->command->info('Committee table seeded!');
    /*
		$this->call('TimeideaTableSeeder');
		$this->command->info('Timeidea table seeded!');
    
    	$this->call('PollTableSeeder');
    	$this->command->info('Poll table seeded!');
    */
  }

}
