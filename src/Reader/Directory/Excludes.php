<?php
/**
 * Class Excludes
 *
 * @package Kachit\Config\Reader\Directory
 * @author Kachit
 */
namespace Kachit\Config\Reader\Directory;

class Excludes
{
    /**
     * @var array
     */
    protected $extensions = [
        'dist'
    ];

    /**
     * @var array
     */
    protected $files = [];

    /**
     * @return array
     */
    public function getExtensions(): array
    {
        return $this->extensions;
    }

    /**
     * @param array $extensions
     * @return Excludes
     */
    public function setExtensions(array $extensions): Excludes
    {
        $this->extensions = $extensions;
        return $this;
    }

    /**
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @param array $files
     * @return Excludes
     */
    public function setFiles(array $files): Excludes
    {
        $this->files = $files;
        return $this;
    }
}