<?php
/**
 * Class AbstractReader
 * @package Kachit\Config\Reader
 */
namespace Kachit\Config\Writer;

use Kachit\Config\WriterInterface;

abstract class AbstractWriter implements WriterInterface
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * AbstractReader constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * @param array $options
     * @return AbstractWriter
     */
    public function setOptions(array $options): AbstractWriter
    {
        $this->options = $options;
        return $this;
    }
}