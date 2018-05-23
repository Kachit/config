<?php
/**
 * Class Php reader
 */
namespace Kachit\Config\Reader;

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
}