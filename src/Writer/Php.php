<?php
/**
 * Class Php
 *
 * @package Kachit\Config\Writer
 * @author Kachit
 */
namespace Kachit\Config\Writer;

use Kachit\Config\ConfigInterface;

class Php extends AbstractFile
{
    /**
     * @param ConfigInterface $config
     * @param string|null $path
     * @return bool
     */
    public function writeFile(ConfigInterface $config, string $path = null): bool
    {
        return file_put_contents($path, "<?php \nreturn " . var_export($config->toArray(), true) . ";");
    }
}