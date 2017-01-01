<?php
use Kachit\Config\Manager;
use Codeception\Util\Debug;
use Kachit\Config\Reader\Json as JsonReader;
use Kachit\Config\Reader\Php as PhpReader;

class ConfigManagerTest extends \Codeception\Test\Unit
{

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     *
     */
    public function testReadConfigJson()
    {
        $reader = new JsonReader();
        $manager = new Manager($reader);
        $config = $manager->read('tests/_data/stubs/config.json');
        $this->assertTrue(is_object($config));
        $this->assertInstanceOf('Kachit\Config\Config', $config);
        $this->assertInstanceOf('Kachit\Config\ConfigInterface', $config);
        $this->assertEquals('bar', $config->foo);
        $this->assertEquals(123, $config->baz);
    }

    /**
     *
     */
    public function testReadConfigPhp()
    {
        $reader = new PhpReader();
        $manager = new Manager($reader);
        $config = $manager->read('tests/_data/stubs/config.php');
        $this->assertTrue(is_object($config));
        $this->assertInstanceOf('Kachit\Config\Config', $config);
        $this->assertInstanceOf('Kachit\Config\ConfigInterface', $config);
        $this->assertEquals('bar', $config->foo);
        $this->assertEquals(123, $config->baz);
    }
}