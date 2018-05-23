<?php
use Kachit\Config\Config;
use Codeception\Util\Debug;
use Kachit\Config\Reader\Json as Reader;
use Kachit\Config\Manager;

class JsonFileReaderTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     *
     */
    public function testReadConfigWithExtension()
    {
        $reader = new Reader();
        $manager = new Manager($reader);
        $config = $manager->read('tests/_data/stubs/read/config.json');
        $this->assertTrue(is_object($config));
        $this->assertInstanceOf('Kachit\Config\Config', $config);
        $this->assertEquals('bar', $config->foo);
        $this->assertEquals(123, $config->baz);
    }

    /**
     *
     */
    public function testReadConfigWithBasePath()
    {
        $reader = new Reader(['base_path' => 'tests/_data/stubs/read']);
        $manager = new Manager($reader);
        $config = $manager->read('config.json');
        $this->assertTrue(is_object($config));
        $this->assertInstanceOf('Kachit\Config\Config', $config);
        $this->assertEquals('bar', $config->foo);
        $this->assertEquals(123, $config->baz);
    }

    /**
     *
     */
    public function testReadConfigWithoutExtension()
    {
        $reader = new Reader();
        $manager = new Manager($reader);
        $config = $manager->read('tests/_data/stubs/read/config');
        $this->assertTrue(is_object($config));
        $this->assertInstanceOf('Kachit\Config\Config', $config);
        $this->assertEquals('bar', $config->foo);
        $this->assertEquals(123, $config->baz);
    }

    /**
     *
     */
    public function testReadConfigWithoutExtensionWithSlash()
    {
        $reader = new Reader();
        $manager = new Manager($reader);
        $config = $manager->read('tests/_data/stubs/read/config/');
        $this->assertTrue(is_object($config));
        $this->assertInstanceOf('Kachit\Config\Config', $config);
        $this->assertEquals('bar', $config->foo);
        $this->assertEquals(123, $config->baz);
    }
}