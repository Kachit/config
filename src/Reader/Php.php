<?php
/**
 * Class Php reader
 *
 * @package Kachit\Config\Reader
 * @author Kachit
 */
namespace Kachit\Config\Reader;

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
}