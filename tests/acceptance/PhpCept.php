<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('check the php version');
$I->amOnPage('/php-test.php');
$I->see('jotain');