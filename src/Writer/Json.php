<?php
/**
 * Class Json
 *
 * @package Kachit\Config\Writer
 * @author Kachit
 */
namespace Kachit\Config\Writer;

use Kachit\Config\ConfigInterface;
use Kachit\Config\Extensions;

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

    /**
     * @return string
     */
    protected function getExtension(): string
    {
        return Extensions::JSON;
    }
}