<?php 
$I = new FunctionalTester($scenario);
$I->haveRecord('committees', array('name' => 'eka_toimikunta', 'time' => 'joskus', 'is_open' => 1));
$I->wantTo('see that there is only eka_toimikunta on the list of committees');
$I->amOnPage('/');
$I->see('eka_toimikunta');
$I->dontSee('toka_toimikunta');