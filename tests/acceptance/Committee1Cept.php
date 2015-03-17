<?php 
$I = new AcceptanceTester($scenario);
$user_id = $I->haveRecord('committees', array('name' => 'eka_toimikunta', 'time' => 'joskus', 'is_open' => 1));
$I->wantTo('see that there is only eka_toimikunta on the list of committees');
$I->amOnPage('/');
$I->resizeWindow(1024, 768);
$I->see('eka_toimikunta');
$I->dontSee('toka_toimikunta');