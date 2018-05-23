<?php
/**
 * Class FileFactory
 *
 * @package Kachit\Config\Reader
 * @author Kachit
 */
namespace Kachit\Config\Reader;

use Kachit\Config\ConfigException;
use Kachit\Config\ReaderInterface;
use Kachit\Config\Extensions;

class FileFactory extends AbstractReader
{
    /**
     * @var array
     */
    private $readersMap = [
        Extensions::INI => Ini::class,
        Extensions::PHP => Php::class,
        Extensions::JSON => Json::class,
        Extensions::YAML => Yaml::class,
        Extensions::YML => Yaml::class,
    ];

    /**
     * @param string $path
     * @return array
     * @throws ConfigException
     */
    public function read($path = null): array
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if (!isset($this->readersMap[$extension])) {
            throw new ConfigException(sprintf('File with extension "%s" is not supported', $extension));
        }
        /* @var ReaderInterface $reader */
        $reader = new $this->readersMap[$extension]($this->options);
        return $reader->read($path);
    }
}