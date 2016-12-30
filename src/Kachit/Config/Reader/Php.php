<?php
/**
 * Class Php reader
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