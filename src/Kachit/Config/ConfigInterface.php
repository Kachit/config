<?php
namespace Kachit\Config;
/**
 * Class ConfigInterface
 */
interface ConfigInterface
{
    /**
     * @return array
     */
    public function toArray();

    /**
     * @param string $key
     * @param string|null $default
     * @return mixed
     */
    public function get(string $key, string $default = null);

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * @param string $key
     * @param $value
     * @return ConfigInterface
     */
    public function set(string $key, $value) :ConfigInterface;

    /**
     * @param string $key
     * @return ConfigInterface
     */
    public function remove(string $key) :ConfigInterface;

    /**
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * @param array $array
     * @return ConfigInterface
     */
    public function fillFromArray(array $array = []) :ConfigInterface;

    /**
     * @param ConfigInterface $config
     * @return ConfigInterface
     */
    public function merge(ConfigInterface $config) :ConfigInterface;
}