<?php

class PollTableSeeder extends Seeder {

  public function run() {
    DB::table('polls')->delete();

    Poll::create(array('toimikunta' => 'Pentin toimikunta'));
    Poll::insert(array('toimikunta' => 'Matin toimikunta'));
    Poll::insert(array('toimikunta' => 'Tanjan toimikunta'));
  }
}
