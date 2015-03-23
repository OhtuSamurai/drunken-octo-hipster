<?php

class TimeideaTableSeeder extends Seeder {

  /**
   * Seeds Date-table.
   * For testing and demo purposes
   */
  public function run() {
    //DB::table('timeideas')->delete();

    Timeidea::create(array('idea' => 'oispa kaljaa',
                       'poll_id'=>4));
    Timeidea::insert(array('idea' => '5.5.2015 aamusta',
                       'poll_id'=>4));
	Timeidea::insert(array('idea' => 'Maaliskuun alussa',
                       'poll_id'=>4));
  }
}
