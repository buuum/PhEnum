<?php

namespace PhEnum;

abstract class PhEnum
{

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var array
     */
    private static $consts = [];

    public function __construct($value)
    {
        if (!self::isValid($value)) {
            throw new \Exception("This value is incorrect!");
        }

        $this->value = $value;
    }


    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns the enum key (i.e. the constant name).
     *
     * @return mixed
     */
    public function getKey()
    {
        return self::search($this->value);
    }

    /**
     * @param PhEnum $enum
     * @return bool
     */
    final public function equals(PhEnum $enum)
    {
        return $this->getValue() === $enum->getValue();
    }

    /**
     * @return array
     */
    public static function keys()
    {
        return array_keys(static::toArray());
    }

    /**
     * @return array
     */
    public static function values()
    {
        return array_values(static::toArray());
    }

    /**
     * @param $value
     * @param bool $strict
     * @return bool
     */
    public static function isValid($value,  $strict = true)
    {
        return in_array($value, static::toArray(), $strict);
    }

    /**
     * @param $key
     * @return bool
     */
    public static function isValidKey($key)
    {
        $array = static::toArray();
        return isset($array[$key]);
    }


    /**
     * @param $value
     * @return mixed
     */
    public static function search($value)
    {
        $constants = self::toArray();
        return array_search($value, $constants, true);
    }

    /**
     * @return mixed
     */
    public static function toArray()
    {
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$consts)) {
            $reflect = new \ReflectionClass($calledClass);
            self::$consts[$calledClass] = $reflect->getConstants();
        }
        return self::$consts[$calledClass];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value;
    }

    /**
     * @param $name
     * @param $arguments
     * @return static
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments)
    {
        $array = static::toArray();
        if (isset($array[$name])) {
            return new static($array[$name]);
        }
        throw new \Exception("No static method or enum constant '$name' in class " . get_called_class());
    }
}