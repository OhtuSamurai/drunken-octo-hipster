<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('see the list of inactive users');
$I->amOnPage('/login');
$I->click('Toggle navigation');
$I->dontSee('Poolista poistetut käyttäjät', 'nav');
$I->fillField('username', 'matti');
$I->click('Kirjaudu');
$I->click('Toggle navigation');
$I->see('Poolista poistetut käyttäjät', 'nav');
