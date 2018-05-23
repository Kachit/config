<?php
/**
 * Class AbstractFile
 *
 * @package Kachit\Config\Reader
 * @author Kachit
 */
namespace Kachit\Config\Reader;

use Kachit\Config\ConfigException;

abstract class AbstractFile extends AbstractReader
{
    /**
     * @param null $path
     * @return array
     * @throws ConfigException
     */
    public function read($path = null): array
    {
        $this->checkFile($path);
        return $this->readFile($path);
    }

    /**
     * @param string $path
     * @return array
     */
    abstract protected function readFile(string $path): array;

    /**
     * @param string $path
     * @throws ConfigException
     */
    protected function checkFile($path)
    {
        if (!is_file($path)) {
            throw new ConfigException(sprintf('File "%s" not found', $path));
        }
        if (!is_readable($path)) {
            throw new ConfigException(sprintf('File "%s" not readable', $path));
        }
    }
}