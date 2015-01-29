<?php

class TimeideaTableSeeder extends Seeder {

  /**
   * Seeds Date-table.
   * For testing and demo purposes
   */
  public function run() {
    DB::table('timeideas')->delete();

    Timeidea::create(array('date' => '2015-1-30',
                       'begins' => '09:00:00',
                       'ends' => '11:00:00'));
    Timeidea::insert(array('date' => '2015-1-30',
                       'begins' => '12:00:00',
                       'ends' => '14:00:00'));
	Timeidea::insert(array('date' => '2015-1-30',
		'begins'=>'14:00:00',
		'ends'=>'16:00:00'));
  }
}
