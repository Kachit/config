<?php
use Kachit\Config\Config;
use Codeception\Util\Debug;
use Kachit\Config\Reader\Directory as Reader;
use Kachit\Config\Writer\Directory as Writer;
use Kachit\Config\Reader\Directory\Excludes;

use Kachit\Config\Reader\Php as AdapterReader;
use Kachit\Config\Writer\Php as AdapterWriter;
use Kachit\Config\Manager;

class DirectoryFileWriterTest extends \Codeception\Test\Unit
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
        $excludes = (new Excludes())->setExtensions(['gitkeep']);
        $reader = new Reader(new AdapterReader(), $excludes);
        $writer = new Writer(new AdapterWriter());
        $manager = new Manager($reader, $writer);
        $config = $manager->read('tests/_data/stubs/read/directory');
        $config->foo->list = [1, 2, 3];
        $config->bar->list = [1, 2, 3];
        $manager->write($config, 'tests/_data/stubs/write/directory');
        $actual = $manager->read('tests/_data/stubs/write/directory');
        $this->assertEquals($config->toArray(), $actual->toArray());
    }
}