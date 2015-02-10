<?php
class OtsikkoTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected function setUp()
    {
        //$this->setBrowser('htmlunit');
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://localhost');
    }

    public function testTitle()
    {
        $this->url('index.php');
        $this->assertEquals('oona', $this->title());
    }

}
?>
