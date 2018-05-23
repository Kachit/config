<?php
/**
 * Class FileFactory
 *
 * @package Kachit\Config\Writer
 * @author Kachit
 */
namespace Kachit\Config\Writer;

use Kachit\Config\ConfigInterface;
use Kachit\Config\ConfigException;
use Kachit\Config\WriterInterface;
use Kachit\Config\Extensions;

class FileFactory extends AbstractWriter
{
    /**
     * @var array
     */
    private $writersMap = [
        Extensions::PHP => Php::class,
        Extensions::JSON => Json::class,
        Extensions::YAML => Yaml::class,
        Extensions::YML => Yaml::class,
    ];
    /**
     * @param ConfigInterface $config
     * @param string $path
     * @return bool
     * @throws ConfigException
     */
    public function write(ConfigInterface $config, string $path = null): bool
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if (!isset($this->writersMap[$extension])) {
            throw new ConfigException(sprintf('File with extension "%s" is not supported', $extension));
        }
        /* @var WriterInterface $reader */
        $reader = new $this->writersMap[$extension]($this->options);
        return $reader->write($config, $path);
    }
}