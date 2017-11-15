<?php
/**
 * Class Directory
 *
 * @package Orbitum\Billing\Common\Config\Loader
 * @author Kachit
 */
namespace Kachit\Config\Reader;

use Kachit\Config\ReaderInterface;
use FilesystemIterator;
use SplFileInfo;

class Directory implements ReaderInterface
{
    /**
     * @var ReaderInterface
     */
    private $reader;

    /**
     * @var array
     */
    private $excludes = [];

    /**
     * DirectoryLoader constructor
     *
     * @param ReaderInterface $reader
     * @param array $excludes
     */
    public function __construct(ReaderInterface $reader, array $excludes = ['dist'])
    {
        $this->reader = $reader;
        $this->excludes = $excludes;
    }

    /**
     * @param null $path
     * @return array
     */
    public function read($path = null) :array
    {
        $config = [];
        $iterator = new FilesystemIterator($path, FilesystemIterator::SKIP_DOTS);
        /* @var SplFileInfo $file */
        foreach ($iterator as $file) {
            if (in_array($file->getExtension(), $this->excludes)) {
                continue;
            }
            $extension = '.' . $file->getExtension();
            $config[$file->getBasename($extension)] = $this->reader->read($file->getPathName());
        }
        return $config;
    }
}
