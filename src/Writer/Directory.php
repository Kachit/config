<?php
/**
 * Class Directory
 *
 * @package Kachit\Config\Writer
 * @author Kachit
 */
namespace Kachit\Config\Writer;

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
        return true;
    }
}
