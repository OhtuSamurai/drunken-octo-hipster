<?php 
$I = new FunctionalTester($scenario);
$I->haveRecord('users', array('first_name' => 'Tiina', 'last_name' => 'Tonttu', 'department' => 'd', 'position' => 'p', 'username' => 'tiina', 'is_admin' => 0));
$I->wantTo('log in');
$I->amOnPage('/');

$I->click('Kirjaudu sisään');

$I->seeCurrentUrlEquals('/login');
$I->see('Sisäänkirjautuminen');

$I->submitForm('#loginForm', array('username' => 'tiina'));

$I->see('Tiina Tonttu');