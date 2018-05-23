<?php
use Kachit\Config\Config;
use Codeception\Util\Debug;
use Kachit\Config\Reader\Php as Reader;
use Kachit\Config\Writer\Php as Writer;
use Kachit\Config\Manager;

class PhpFileWriterTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     *
     */
    public function testWriteConfigWithExtension()
    {
        $reader = new Reader();
        $writer = new Writer();
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
    public function testWriteConfigWithBasePath()
    {
        $reader = new Reader();
        $writer = new Writer(['base_path' => 'tests/_data/stubs/write']);
        $manager = new Manager($reader, $writer);
        $config = $manager->read('tests/_data/stubs/read/config');
        $config->list = [1, 2, 3];
        $manager->write($config, 'config');
        $actual = $manager->read('tests/_data/stubs/write/config');
        $this->assertEquals($config->toArray(), $actual->toArray());
    }

    /**
     *
     */
    public function testWriteConfigWithoutExtension()
    {
        $reader = new Reader();
        $writer = new Writer();
        $manager = new Manager($reader, $writer);
        $config = $manager->read('tests/_data/stubs/read/config');
        $config->list = [1, 2, 3];
        $manager->write($config, 'tests/_data/stubs/write/config');
        $actual = $manager->read('tests/_data/stubs/write/config');
        $this->assertEquals($config->toArray(), $actual->toArray());
    }
}