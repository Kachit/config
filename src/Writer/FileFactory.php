<?php
/**
 * Class FileFactory
 *
 * @author Kachit
 * @package Kachit\Config\Writer
 */
namespace Kachit\Config\Writer;

use Kachit\Config\ConfigInterface;
use Kachit\Config\ConfigException;
use Kachit\Config\WriterInterface;

class FileFactory extends AbstractFile
{
    /**
     * @var array
     */
    private $writersMap = [
        'php' => Php::class,
        'json' => Json::class,
        'yaml' => Yaml::class,
        'yml' => Yaml::class,
    ];
    /**
     * @param ConfigInterface $config
     * @param string $path
     * @return bool
     * @throws ConfigException
     */
    public function writeFile(ConfigInterface $config, string $path): bool
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if (!isset($this->writersMap[$extension])) {
            throw new ConfigException(sprintf('File with extension "%s" is not supported', $extension));
        }
        /* @var WriterInterface $reader */
        $reader = new $this->writersMap[$extension];
        return $reader->write($config, $path);
    }
}