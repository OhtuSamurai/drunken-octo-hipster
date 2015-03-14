<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('see the list of inactive users');
$I->amOnPage('/');
$I->resizeWindow(1024, 768);
$I->dontSee('Poolista poistetut käyttäjät', 'nav');
$I->loginToSite('matti', $I);
$I->see('Poolista poistetut käyttäjät', 'nav');