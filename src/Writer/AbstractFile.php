<?php
/**
 * Class AbstractFile
 * @package Kachit\Config\Reader
 */
namespace Kachit\Config\Writer;

use Kachit\Config\ConfigException;
use Kachit\Config\ConfigInterface;

abstract class AbstractFile extends AbstractWriter
{
    /**
     * @param ConfigInterface $config
     * @param string|null $path
     * @return bool
     */
    public function write(ConfigInterface $config, string $path = null): bool
    {
        $this->createDirectory($path);
        return $this->writeFile($config, $path);
    }

    /**
     * @param ConfigInterface $config
     * @param string $path
     * @return bool
     */
    abstract protected function writeFile(ConfigInterface $config, string $path): bool;

    /**
     * @param string $path
     * @throws ConfigException
     */
    protected function createDirectory($path)
    {
        $directory = pathinfo($path, PATHINFO_DIRNAME);
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
    }
}