<?php
/**
 * Class Json
 * @package Kachit\Config\Writer
 */
namespace Kachit\Config\Writer;

use Kachit\Config\ConfigInterface;

class Json extends AbstractFile
{
    /**
     * @param ConfigInterface $config
     * @param string|null $path
     * @return bool
     */
    public function writeFile(ConfigInterface $config, string $path = null): bool
    {
        return file_put_contents($path, json_encode($config, JSON_PRETTY_PRINT));
    }
}