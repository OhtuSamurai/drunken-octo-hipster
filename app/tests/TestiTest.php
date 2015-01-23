<?php

class TestiTest extends TestCase {

	/**
   * Author: mihassin
	 * Eka testi template-view:iä varten
	 *
	 * @return void
	 */
	public function testTestiTemplatenSisalto()
	{
		$crawler = $this->client->request('GET', 'testi');

		$this->assertTrue($this->client->getResponse()->isOk());

    $this->assertCount(1, $crawler->filter('body:contains("ajat")'));
	}

}
