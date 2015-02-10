<?php
class OtsikkoTest extends PHPUnit_Extensions_Selenium2TestCase
{

    protected function setUp()
    {
        $this->setHost('localhost');
        $this->setPort(4444);
        $this->setBrowser('htmlunit');
        //$this->setBrowser('firefox');
        $this->setBrowserUrl('http://homestead.app/');   
    }

    public function testTitle()
    {
        $this->url('index.php');
        $this->assertEquals('oona', $this->title());
    }

}
?>
