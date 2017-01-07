<?php
use Kachit\Config\Config;
use Codeception\Util\Debug;
use Kachit\Config\Reader\FileFactory as Reader;
use Kachit\Config\Writer\FileFactory as Writer;
use Kachit\Config\Manager;

class WriterFileFactoryTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     *
     */
    public function testWriteConfigJson()
    {
        $reader = new Reader();
        $writer = new Writer();
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
    public function testWriteConfigNotSupportFile()
    {
        $this->expectException('Kachit\Config\ConfigException');
        $this->expectExceptionMessage('File with extension "inc" is not supported');
        $reader = new Reader();
        $writer = new Writer();
        $manager = new Manager($reader, $writer);
        $config = $manager->read('tests/_data/stubs/read/config.php');
        $manager->write($config, 'tests/_data/stubs/write/config.inc');
    }
}