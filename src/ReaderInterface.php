<?php
namespace Kachit\Config;

/**
 * Class ReaderInterface
 */
interface ReaderInterface
{
    /**
     * @param null $path
     * @return array
     */
    public function read($path = null) :array;
}