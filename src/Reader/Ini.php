<?php
/**
 * Class Ini reader
 *
 * @package Kachit\Config\Reader
 * @author Kachit
 */
namespace Kachit\Config\Reader;

use Kachit\Config\Extensions;

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

    /**
     * @return string
     */
    protected function getExtension(): string
    {
        return Extensions::INI;
    }
}