<?php
/**
 * Class AbstractReader
 *
 * @package Kachit\Config\Reader
 * @author Kachit
 */
namespace Kachit\Config\Reader;

use Kachit\Config\ReaderInterface;

abstract class AbstractReader implements ReaderInterface
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
     * @return AbstractReader
     */
    public function setOptions(array $options): AbstractReader
    {
        $this->options = $options;
        return $this;
    }
}