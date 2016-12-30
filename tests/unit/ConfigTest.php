<?php
use Kachit\Config\Config;
use Codeception\Util\Debug;

class ConfigTest extends \Codeception\Test\Unit
{

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     *
     */
    public function testConfigSimple()
    {
        $data = ['foo' => 'bar', 'buz' => 'baz'];
        $config = new Config($data);
        $this->assertFalse($config->isEmpty());
        $this->assertEquals($data['foo'], $config['foo']);
        $this->assertEquals($data['buz'], $config['buz']);
        $this->assertEquals($data['foo'], $config->foo);
        $this->assertEquals($data['buz'], $config->buz);
        $this->assertEquals($data, $config->toArray());
    }

    /**
     *
     */
    public function testForeach()
    {
        $data = ['foo' => 'bar', 'buz' => 'baz'];
        $config = new Config($data);
        foreach ($config as $key => $value) {
            $this->assertEquals($data[$key], $value);
        }
    }

    public function testComplexConfig()
    {
        $data = ['foo' => 'bar', 'buz' => ['foo' => 'bar']];
        $config = new Config($data);
        $this->assertTrue(is_object($config->buz));
        $this->assertInstanceOf('Kachit\Config\Config', $config->buz);
        $this->assertInstanceOf('Kachit\Config\ConfigInterface', $config->buz);
        $this->assertEquals($data['buz'], $config->buz->toArray());
    }

    public function testComplexAlternateConfig()
    {
        $object = new \StdClass();
        $object->foo = 'bar';
        $data = ['foo' => 'bar', 'buz' => $object];
        $config = new Config($data);
        $this->assertTrue(is_object($config->buz));
        $this->assertInstanceOf('Kachit\Config\Config', $config->buz);
        $this->assertInstanceOf('Kachit\Config\ConfigInterface', $config->buz);
        $this->assertEquals(['foo' => 'bar'], $config->buz->toArray());
    }

    public function testMerge()
    {
        $data = ['foo' => 'bar', 'buz' => 'baz'];
        $parent = new Config($data);
        $data = ['foo' => 'bar', 'buz' => 'fuzz', 'goo' => 'do'];
        $child = new Config($data);
        $parent->merge($child);
        $this->assertEquals($data, $parent->toArray());
    }

    public function testMergeAlternative()
    {
        $data = ['foo' => 'bar', 'buz' => 'baz'];
        $parent = new Config($data);
        $parent['buz'] = new Config($data);
        $this->assertEquals($data, $parent->buz->toArray());
    }

    public function testGet()
    {
        $data = ['foo' => 'bar', 'buz' => 'baz'];
        $config = new Config($data);
        $this->assertEquals($data['foo'], $config->get('foo'));
        $this->assertEquals(null, $config->get('no'));
        $this->assertEquals('baz', $config->get('no', 'baz'));
    }

    public function testRemove()
    {
        $data = ['foo' => 'bar', 'buz' => 'baz'];
        $config = new Config($data);
        $this->assertFalse($config->remove('foo')->has('foo'));
    }

    public function testRemoveAlternate()
    {
        $data = ['foo' => 'bar', 'buz' => 'baz'];
        $config = new Config($data);
        unset($config['foo']);
        unset($config->buz);
        $this->assertFalse($config->has('foo'));
        $this->assertFalse($config->has('baz'));
    }
}