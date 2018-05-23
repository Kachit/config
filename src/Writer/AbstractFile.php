<?php
/**
 * Class AbstractFile
 *
 * @package Kachit\Config\Reader
 * @author Kachit
 */
namespace Kachit\Config\Writer;

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
        $path = $this->generateFileName($path);
        return $this->writeFile($config, $path);
    }

    /**
     * @param ConfigInterface $config
     * @param string $path
     * @return bool
     */
    abstract protected function writeFile(ConfigInterface $config, string $path): bool;

    /**
     * @return string
     */
    abstract protected function getExtension(): string;

    /**
     * @param string $path
     * @return string
     */
    protected function generateFileName(string $path): string
    {
        $ds = DIRECTORY_SEPARATOR;
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if (empty($extension)) {
            $path = rtrim($path, $ds) . '.' . $this->getExtension();
        }
        return $path;
    }

    /**
     * @param string $path
     */
    protected function createDirectory(string $path)
    {
        $ds = DIRECTORY_SEPARATOR;
        $directory = pathinfo($path, PATHINFO_DIRNAME);
        if (isset($this->options['base_path'])) {
            $directory = rtrim($this->options['base_path'], $ds) . $ds . ltrim($directory, $ds);
        }
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
    }
}