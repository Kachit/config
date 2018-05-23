<?php
namespace Kachit\Config;
/**
 * Class Manager
 */
class Manager
{
    /**
     * @var ReaderInterface
     */
    private $reader;

    /**
     * @var WriterInterface
     */
    private $writer;

    /**
     * Manager constructor.
     * @param ReaderInterface $reader
     * @param WriterInterface $writer
     */
    public function __construct(ReaderInterface $reader, WriterInterface $writer = null)
    {
        $this->setReader($reader);
        if ($writer) {
            $this->setWriter($writer);
        }
    }

    /**
     * @param ConfigInterface|null $config
     * @param string|null $path
     * @return ConfigInterface|\Stdclass
     */
    public function read(string $path = null, ConfigInterface $config = null) :ConfigInterface
    {
        $data = $this->reader->read($path);
        $config = ($config) ? $config : new Config();
        return $config->fillFromArray($data);
    }

    /**
     * @param ConfigInterface $config
     * @param string|null $path
     * @return bool
     */
    public function write(ConfigInterface $config, string $path = null) :bool
    {
        $this->checkWriter();
        return $this->writer->write($config, $path);
    }

    /**
     * @param ReaderInterface $reader
     * @return Manager
     */
    public function setReader(ReaderInterface $reader)
    {
        $this->reader = $reader;
        return $this;
    }

    /**
     * @param WriterInterface $writer
     * @return Manager
     */
    public function setWriter(WriterInterface $writer)
    {
        $this->writer = $writer;
        return $this;
    }

    /**
     * @throws ConfigException
     */
    protected function checkWriter()
    {
        if (empty($this->writer)) {
            throw new ConfigException('Config writer is not available');
        }
    }
}