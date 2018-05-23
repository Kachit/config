<?php
use Kachit\Config\Config;
use Codeception\Util\Debug;
use Kachit\Config\Reader\Directory as Reader;
use Kachit\Config\Reader\Php;
use Kachit\Config\Manager;

class DirectoryFileReaderTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     *
     */
    public function testReadConfigs()
    {
        $reader = new Reader(new Php());
        $manager = new Manager($reader);
        $config = $manager->read('tests/_data/stubs/read/directory');
        $this->assertTrue(is_object($config));
        $this->assertInstanceOf('Kachit\Config\Config', $config);
        $this->assertEquals('foo', $config->foo->name);
        $this->assertEquals('bar', $config->bar->name);
    }
}