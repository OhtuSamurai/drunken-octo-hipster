<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class FunctionalHelper extends \Codeception\Module
{
	function loginAsAdmin()
	{
		$I = $this->getModule('Laravel4');
		$I->haveRecord('users', array('first_name' => 'Antti', 'last_name' => 'Admin', 'department' => 'd', 'position' => 'p', 'username' => 'antti', 'is_admin' => 1));
		$this->login('antti');
	}

	function login($name)
	{
		$I = $this->getModule('Laravel4');
		$I->amOnPage('/login');
		$I->submitForm('#loginForm', array('username' => $name));
	}
}
