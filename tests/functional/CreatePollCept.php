<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('Create a poll as admin');
$I->loginAsAdmin();
$I->amOnPage('/');
$I->click('Toimikunnat');
$I->click('Luo uusi toimikunta kyselyn kautta');
$I->fillField('toimikunta', 'Eka toimikunta');
$I->see('Pakana');
$I->seeInCurrentUrl('poll/create');
$user = $I->grabRecord('users', array('username' => 'pentti'));
$I->sendAjaxPostRequest('/poll', array('toimikunta' => 'Eka toimikunta', 'user' => [$user->id]));
$I->see('Kyselyn tallennus onnistui!');
