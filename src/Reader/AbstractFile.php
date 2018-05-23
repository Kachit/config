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
        $path = $this->generateFilePath($path);
        $this->checkFile($path);
        return $this->readFile($path);
    }

    /**
     * @param string $path
     * @return array
     */
    abstract protected function readFile(string $path): array;

    /**
     * @return string
     */
    abstract protected function getExtension(): string;

    /**
     * @param string $path
     * @return string
     */
    protected function generateFilePath(string $path): string
    {
        $ds = DIRECTORY_SEPARATOR;
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if (isset($this->options['base_path'])) {
            $path = rtrim($this->options['base_path'], $ds) . $ds . ltrim($path, $ds);
        }
        if (empty($extension)) {
            $path = rtrim($path, $ds) . '.' . $this->getExtension();
        }
        return $path;
    }

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