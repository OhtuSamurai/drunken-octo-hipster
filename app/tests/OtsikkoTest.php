<?php
class OtsikkoTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected function setUp()
    {
        $this->setBrowser('phantomjs');
        $this->setBrowserUrl('http://www.example.com/');
    }

    public function testTitle()
    {
        $this->url('http://homestead.app');
        $this->assertEquals('oona', $this->title());
    }

}
?>