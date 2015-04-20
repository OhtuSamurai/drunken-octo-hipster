<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('See all navbar links as admin');
$I->loginAsAdmin();
$I->amOnPage('/');
$I->see('Toimikunnat');
$I->see('Pooli');
$I->see('Poolin ulkopuoliset käyttäjät');
$I->see('Kyselyt');
$I->see('Antti');
$I->see('Kirjaudu ulos');
$I->dontSee('Kirjaudu sisään');