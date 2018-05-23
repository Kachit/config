<?php
/**
 * Class Php reader
 *
 * @package Kachit\Config\Reader
 * @author Kachit
 */
namespace Kachit\Config\Reader;

use Kachit\Config\Extensions;

class Php extends AbstractFile
{
    /**
     * @param string $path
     * @return array
     */
    protected function readFile(string $path): array
    {
        return include $path;
    }

    /**
     * @return string
     */
    protected function getExtension(): string
    {
        return Extensions::PHP;
    }
}