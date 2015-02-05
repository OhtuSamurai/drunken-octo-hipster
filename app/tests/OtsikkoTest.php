<?php
class OtsikkoTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://www.example.com/');
    }

    public function testTitle()
    {
        $this->url('http://localhost');
        $this->assertEquals('oona', $this->title());
    }

}
?>
