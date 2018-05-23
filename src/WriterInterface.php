<?php
/**
 * Class WriterInterface
 *
 * @package Kachit\Config
 * @author Kachit
 */
namespace Kachit\Config;

interface WriterInterface
{
    /**
     * @param ConfigInterface $config
     * @param string|null $path
     * @return bool
     */
    public function write(ConfigInterface $config, string $path = null): bool;
}