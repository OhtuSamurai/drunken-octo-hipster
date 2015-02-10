<?php
class OtsikkoTest extends PHPUnit_Extensions_Selenium2TestCase
{

    protected $webDriver;

    protected function setUp()
    {
<<<<<<< HEAD
        $this->setHost('localhost');
        $this->setPort(4444);
        $this->setBrowser('htmlunit');
        //$this->setBrowser('firefox');
        $this->setBrowserUrl('http://homestead.app/');   
=======
        //$this->setBrowser('htmlunit');
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://localhost');
>>>>>>> 503388a7601b8ce1ae2c8d2124a610755b95a22e
    }

    public function testTitle()
    {
        $this->url('index.php');
        $this->assertEquals('oona', $this->title());
    }

}
?>
