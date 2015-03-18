<?php 
$I = new AcceptanceTester($scenario);
$user_id = $I->haveRecord('committees', array('name' => 'toka_toimikunta', 'time' => 'joskus', 'is_open' => 1));
$I->wantTo('see that there is only toka_toimikunta on the list of committees');
$I->amOnPage('/');
$I->resizeWindow(1024, 768);
$I->see('toka_toimikunta');
$I->dontSee('eka_toimikunta');