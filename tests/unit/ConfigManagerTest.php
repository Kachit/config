<?php
use Kachit\Config\Manager;
use Codeception\Util\Debug;
use Kachit\Config\Reader\Json as JsonReader;
use Kachit\Config\Reader\Php as PhpReader;
use Kachit\Config\Reader\Ini as IniReader;
use Kachit\Config\Reader\Yaml as YamlReader;

use Kachit\Config\Writer\Json as JsonWriter;
use Kachit\Config\Writer\Php as PhpWriter;

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
        $config = $manager->read('tests/_data/stubs/read/config.json');
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
        $config = $manager->read('tests/_data/stubs/read/config.php');
        $this->assertTrue(is_object($config));
        $this->assertInstanceOf('Kachit\Config\Config', $config);
        $this->assertInstanceOf('Kachit\Config\ConfigInterface', $config);
        $this->assertEquals('bar', $config->foo);
        $this->assertEquals(123, $config->baz);
    }

    /**
     *
     */
    public function testReadConfigIni()
    {
        $reader = new IniReader();
        $manager = new Manager($reader);
        $config = $manager->read('tests/_data/stubs/read/config.ini');
        $this->assertTrue(is_object($config));
        $this->assertInstanceOf('Kachit\Config\Config', $config);
        $this->assertInstanceOf('Kachit\Config\ConfigInterface', $config);
        $this->assertEquals('bar', $config->foo);
        $this->assertEquals(123, $config->baz);
    }

    /**
     *
     */
    public function testWriteConfigJson()
    {
        $reader = new JsonReader();
        $writer = new JsonWriter();
        $manager = new Manager($reader, $writer);
        $config = $manager->read('tests/_data/stubs/read/config.json');
        $config->list = [1, 2, 3];
        $manager->write($config, 'tests/_data/stubs/write/config.json');
        $actual = $manager->read('tests/_data/stubs/write/config.json');
        $this->assertEquals($config->toArray(), $actual->toArray());
    }
    /**
     *
     */
    public function testWriteConfigPhp()
    {
        $reader = new PhpReader();
        $writer = new PhpWriter();
        $manager = new Manager($reader, $writer);
        $config = $manager->read('tests/_data/stubs/read/config.php');
        $config->list = [1, 2, 3];
        $manager->write($config, 'tests/_data/stubs/write/config.php');
        $actual = $manager->read('tests/_data/stubs/write/config.php');
        $this->assertEquals($config->toArray(), $actual->toArray());
    }
    /**
     *
     */
    public function testWriteConfigWithoutWriter()
    {
        $this->expectException('Kachit\Config\ConfigException');
        $this->expectExceptionMessage('Config writer is not available');
        $reader = new PhpReader();
        $manager = new Manager($reader);
        $config = $manager->read('tests/_data/stubs/read/config.php');
        $manager->write($config, 'tests/_data/stubs/write/config.php');
    }
}