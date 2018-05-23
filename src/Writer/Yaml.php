<?php
/**
 * Class Php
 *
 * @package Kachit\Config\Writer
 * @author Kachit
 */
namespace Kachit\Config\Writer;

use Kachit\Config\ConfigInterface;
use Kachit\Config\Extensions;

class Yaml extends AbstractFile
{
    /**
     * @param ConfigInterface $config
     * @param string|null $path
     * @return bool
     */
    public function writeFile(ConfigInterface $config, string $path = null): bool
    {
        return yaml_emit_file($path, $config->toArray());
    }

    /**
     * @return string
     */
    protected function getExtension(): string
    {
        return Extensions::YAML;
    }
}