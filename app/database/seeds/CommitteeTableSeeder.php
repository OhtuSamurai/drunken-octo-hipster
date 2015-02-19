<?php

class CommitteeTableSeeder extends Seeder {

  public function run() {
    DB::table('committees')->delete();

    Committee::create(array('name' => 'Eskon toimikunta', 'time' => 'ensi keskiviikkona'));
    Committee::create(array('name' => 'Sepon toimikunta', 'time' => 'maaliskuussa'));
    Committee::create(array('name' => 'Teron toimikunta', 'time' => 'toissapäivänä'));
  }
}
