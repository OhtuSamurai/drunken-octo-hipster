<?php

class UserTableSeeder extends Seeder {

  /**
   * Seeds User-table.
   * For testing and demo purposes
   */
  public function run() {
    DB::table('users')->delete();

    User::create(array('first_name' => 'Matti',
                       'last_name' => 'Meikäläinen',
                       'department' => 'Tietojenkäsittelytiede',
                       'position' => 'Professori'));
    User::insert(array('first_name' => 'Pentti',
                       'last_name' => 'Pakana',
                       'department' => 'Fysiikka',
                       'position' => 'Opiskelija'));
    User::insert(array('first_name' => 'Tanja',
                       'last_name' => 'Tatti',
                       'department' => 'Matematiikka ja tilastotiede',
                       'position' => 'Lehtori'));
    User::insert(array('first_name' => 'Maija',
                       'last_name' => 'Teikäläinen',
                       'department' => 'Fysiikka',
                       'position' => 'Opiskelija'));
    User::insert(array('first_name' => 'Seppo',
                       'last_name' => 'Suppanen',
                       'department' => 'Tietojenkäsittelytiede',
                       'position' => 'Professori'));
  }
}
