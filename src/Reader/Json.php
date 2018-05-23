<?php
/**
 * Class Json reader
 *
 * @package Kachit\Config\Reader
 * @author Kachit
 */
namespace Kachit\Config\Reader;

use Kachit\Config\Extensions;

class Json extends AbstractFile
{
    /**
     * @param string $path
     * @return array
     */
    protected function readFile(string $path): array
    {
        return json_decode(file_get_contents($path), true);
    }

    /**
     * @return string
     */
    protected function getExtension(): string
    {
        return Extensions::JSON;
    }
}