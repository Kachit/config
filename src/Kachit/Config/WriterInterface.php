<?php
namespace Kachit\Config;

/**
 * Class ReaderInterface
 */
interface WriterInterface
{
    /**
     * @param ConfigInterface $config
     * @param string|null $path
     * @return bool
     */
    public function write(ConfigInterface $config, string $path = null) :bool;
}