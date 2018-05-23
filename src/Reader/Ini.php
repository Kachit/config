<?php
/**
 * Class Php reader
 */
namespace Kachit\Config\Reader;

class Ini extends AbstractFile
{
    /**
     * @param string $path
     * @return array
     */
    protected function readFile(string $path): array
    {
        return parse_ini_file($path);
    }
}