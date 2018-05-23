<?php
/**
 * Class DirectoryReader
 *
 * @package Kachit\Config\Reader
 * @author Kachit
 */
namespace Kachit\Config\Reader;

use Kachit\Config\ReaderInterface;
use Kachit\Config\Reader\Directory\Excludes;

use FilesystemIterator;
use SplFileInfo;

class Directory implements ReaderInterface
{
    /**
     * @var ReaderInterface
     */
    private $reader;

    /**
     * @var Excludes
     */
    private $excludes;

    /**
     * DirectoryLoader constructor
     *
     * @param ReaderInterface $reader
     * @param Excludes $excludes
     */
    public function __construct(ReaderInterface $reader, Excludes $excludes = null)
    {
        $this->reader = $reader;
        $this->excludes = $excludes ?? new Excludes();
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
            if ($this->filterFileByExtension($file)) {
                continue;
            }
            if ($this->filterFileByName($file)) {
                continue;
            }
            $extension = '.' . $file->getExtension();
            $config[$file->getBasename($extension)] = $this->reader->read($file->getPathName());
        }
        return $config;
    }

    /**
     * @param SplFileInfo $file
     * @return bool
     */
    protected function filterFileByExtension(SplFileInfo $file): bool
    {
        $extensions = $this->excludes->getExtensions();
        return ($extensions && in_array($file->getExtension(), $extensions));
    }

    /**
     * @param SplFileInfo $file
     * @return bool
     */
    protected function filterFileByName(SplFileInfo $file): bool
    {
        $files = $this->excludes->getFiles();
        return ($files && in_array($file->getFilename(), $files));
    }
}
