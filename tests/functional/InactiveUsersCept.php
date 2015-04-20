<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('not be able to see inactive users when not logged in');
$I->amOnPage('/');
$I->dontSee('Poolista poistetut käyttäjät', 'nav');