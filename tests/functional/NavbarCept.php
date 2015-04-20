<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('Not see all navbar links when not logged in');
$I->amOnPage('/');
$I->see('Toimikunnat');
$I->dontSee('Pooli');
$I->dontSee('Poolin ulkopuoliset käyttäjät');
$I->dontSee('Kyselyt');
$I->dontSee('Kirjaudu ulos');
$I->see('Kirjaudu sisään');