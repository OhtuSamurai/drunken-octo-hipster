<?php

class AdminControllerTest extends TestCase {

	public function testShowAdminPage() {
		$response = $this->action('GET', 'AdminController@showAdminPage');

		$view = $response->original;
		$admin_ctrl = new AdminController;
		$this->assertEquals($admin_ctrl->showAdminPage(), $view );
	}
}