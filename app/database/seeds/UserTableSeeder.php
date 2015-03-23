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
                       'position' => 'Professori',
                       'username' => 'matti',
                       'is_admin' => 1,
                       'is_active' => 0));
    User::create(array('first_name' => 'Pentti',
                       'last_name' => 'Pakana',
                       'department' => 'Fysiikka',
                       'position' => 'Opiskelija',
                       'username' => 'pentti',
                       'is_admin' => 0,
                       'is_active' => 1));
    User::create(array('first_name' => 'Tanja',
                       'last_name' => 'Tatti',
                       'department' => 'Matematiikka ja tilastotiede',
                       'position' => 'Lehtori',
                       'username' => 'tanja',
                       'is_admin' => 0,
                       'is_active' => 1));
    User::create(array('first_name' => 'Maija',
                       'last_name' => 'Teikäläinen',
                       'department' => 'Fysiikka',
                       'position' => 'Opiskelija',
                       'username' => 'maija',
                       'is_admin' => 0,
                       'is_active' => 1));
    User::create(array('first_name' => 'Seppo',
                       'last_name' => 'Suppanen',
                       'department' => 'Tietojenkäsittelytiede',
                       'position' => 'Professori',
                       'username' => 'seppo',
                       'is_admin' => 0,
                       'is_active' => 0));
    User::create(array('first_name' => 'Teppo',
                       'last_name' => 'Testaaja',
                       'department' => 'Tietojenkäsittelytiede',
                       'position' => 'Professori',
                       'username' => 'testi',
                       'is_admin' => 0,
                       'is_active' => 0));
  }
}
