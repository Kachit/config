<?php
use Kachit\Config\Config;
use Codeception\Util\Debug;
use Kachit\Config\Reader\FileFactory as Reader;
use Kachit\Config\Manager;

class ReaderFileFactoryTest extends \Codeception\Test\Unit
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
        $reader = new Reader();
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
    public function testReadConfigIni()
    {
        $reader = new Reader();
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
    public function testReadConfigPhp()
    {
        $reader = new Reader();
        $manager = new Manager($reader);
        $config = $manager->read('tests/_data/stubs/read/config.php');
        $this->assertTrue(is_object($config));
        $this->assertInstanceOf('Kachit\Config\Config', $config);
        $this->assertEquals('bar', $config->foo);
        $this->assertEquals(123, $config->baz);
    }
    /**
     *
     */
    public function testReadConfigNotExistingFile()
    {
        $this->expectException('Kachit\Config\ConfigException');
        $this->expectExceptionMessage('File "tests/_data/stubs/read/config.foo" not found');
        $reader = new Reader();
        $manager = new Manager($reader);
        $manager->read('tests/_data/stubs/read/config.foo');
    }
    /**
     *
     */
    public function testReadConfigNotAvailableFile()
    {
        $this->expectException('Kachit\Config\ConfigException');
        $this->expectExceptionMessage('File with extension "inc" is not supported');
        $reader = new Reader();
        $manager = new Manager($reader);
        $manager->read('tests/_data/stubs/read/config.inc');
    }
}