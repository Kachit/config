<?php
/**
 * Class FileFactory
 *
 * @author Kachit
 * @package Kachit\Config\Reader
 */
namespace Kachit\Config\Reader;

use Kachit\Config\ConfigException;
use Kachit\Config\ReaderInterface;

class FileFactory extends AbstractFile
{
    /**
     * @var array
     */
    private $readersMap = [
        'ini' => Ini::class,
        'php' => Php::class,
        'json' => Json::class,
        'yaml' => Yaml::class,
        'yml' => Yaml::class,
    ];
    /**
     * @param string $path
     * @return array
     * @throws ConfigException
     */
    protected function readFile(string $path): array
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if (!isset($this->readersMap[$extension])) {
            throw new ConfigException(sprintf('File with extension "%s" is not supported', $extension));
        }
        /* @var ReaderInterface $reader */
        $reader = new $this->readersMap[$extension];
        return $reader->read($path);
    }
}