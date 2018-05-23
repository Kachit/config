<?php
/**
 * Class Yaml reader
 *
 * @package Kachit\Config\Reader
 * @author Kachit
 */
namespace Kachit\Config\Reader;

use Kachit\Config\Extensions;

class Yaml extends AbstractFile
{
    /**
     * @param string $path
     * @return array
     */
    protected function readFile(string $path): array
    {
        return yaml_parse_file($path);
    }

    /**
     * @return string
     */
    protected function getExtension(): string
    {
        return Extensions::YAML;
    }
}