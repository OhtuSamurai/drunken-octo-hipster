<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the front page works');
$I->amOnPage('/');
$I->see('Toimikunnat');
$I->dontSee('Elefantti');
