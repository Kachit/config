<?php
/**
 * Class Directory
 *
 * @package Kachit\Config\Writer
 * @author Kachit
 */
namespace Kachit\Config\Writer;

use Kachit\Config\Config;
use Kachit\Config\ConfigInterface;
use Kachit\Config\WriterInterface;

use FilesystemIterator;
use SplFileInfo;

class Directory implements WriterInterface
{
    /**
     * @var WriterInterface
     */
    private $writer;

    /**
     * DirectoryLoader constructor
     *
     * @param WriterInterface $writer
     */
    public function __construct(WriterInterface $writer)
    {
        $this->writer = $writer;
    }

    /**
     * @param ConfigInterface $config
     * @param string|null $path
     * @return bool
     */
    public function write(ConfigInterface $config, string $path = null): bool
    {
        $result = false;
        $ds = DIRECTORY_SEPARATOR;
        foreach ($config->toArray() as $fileName => $data) {
            $filePath = rtrim($path, $ds) . $ds . $fileName;
            $result = $this->writer->write(new Config($data), $filePath);
        }
        return $result;
    }
}
