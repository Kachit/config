<?php
namespace Kachit\Config;

/**
 * Class Config
 */
class Config extends \StdClass implements ConfigInterface, \ArrayAccess, \JsonSerializable
{
    /**
     * Config constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->fillFromArray($config);
    }

    /**
     * @param string $key
     * @param string|null $default
     * @return mixed
     */
    public function get(string $key, string $default = null)
    {
        $key = $this->convertOffset($key);
        return ($this->offsetExists($key)) ? $this->$key : $default;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key)
    {
        $key = $this->convertOffset($key);
        return isset($this->$key);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return ConfigInterface
     */
    public function set(string $key, $value): ConfigInterface
    {
        $key = $this->convertOffset($key);
        $this->fill($key, $value);
        return $this;
    }

    /**
     * @param string $key
     * @return ConfigInterface
     */
    public function remove(string $key): ConfigInterface
    {
        $key = $this->convertOffset($key);
        if ($this->offsetExists($key)) {
            $this->$key = null;
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty(get_object_vars($this));
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [];
        foreach ($this as $key => $value) {
            if (is_object($value) && method_exists($value, 'toArray')) {
                /* @var ConfigInterface $value */
                $array[$key] = $value->toArray();
            } else {
                $array[$key] = $value;
            }
        }
        return $array;
    }

    /**
     * @param array $array
     * @return ConfigInterface
     */
    public function fillFromArray(array $array = []): ConfigInterface
    {
        foreach ($array as $key => $value) {
            $this->fill($key, $value);
        }
        return $this;
    }

    /**
     * @param ConfigInterface $config
     * @return ConfigInterface
     */
    public function merge(ConfigInterface $config): ConfigInterface
    {
        foreach ($config as $key => $value) {
            $this->fill($key, $value);
        }
        return $this;
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }


    /**
     * @param mixed $offset
     * @return string
     */
    protected function convertOffset($offset) :string
    {
        return (string)$offset;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    protected function fill(string $key, $value)
    {
        if (is_array($value)) {
            $this->$key = new static($value);
        } elseif ($value instanceof ConfigInterface) {
            $this->$key = new static();
            $this->$key->merge($value);
        } elseif (is_object($value)) {
            $value = (array) $value;
            $this->$key = new static($value);
        } else {
            $this->$key = $value;
        }
    }
}