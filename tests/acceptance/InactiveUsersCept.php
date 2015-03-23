<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('not be able to see inactive users when not logged in');
$I->amOnPage('/');
$I->resizeWindow(1024, 768);
$I->dontSee('Poolista poistetut käyttäjät', 'nav');