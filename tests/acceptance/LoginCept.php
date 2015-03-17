<?php 
$I = new AcceptanceTester($scenario);
$I->haveRecord('users', array('first_name' => 'Tiina', 'last_name' => 'Tonttu', 'department' => 'd', 'position' => 'p', 'username' => 'tiina', 'is_admin' => 0, 'is_active' => 1));
$I->wantTo('log in');
$I->amOnPage('/');
$I->resizeWindow(1024, 768);
$I->click('Kirjaudu sisään');
$I->fillField('username', 'tiina');
$I->click('Kirjaudu');
$I->resizeWindow(1024, 768);
$I->click('Toggle navigation');
$I->see('Tiina');