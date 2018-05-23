<?php
/**
 * Class ReaderInterface
 *
 * @package Kachit\Config
 * @author Kachit
 */
namespace Kachit\Config;

interface ReaderInterface
{
    /**
     * @param null $path
     * @return array
     */
    public function read($path = null): array;
}