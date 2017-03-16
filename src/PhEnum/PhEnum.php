<?php

namespace PhEnum;

abstract class PhEnum
{

    public $value;

    public function __construct($value)
    {
        if (!self::isValidValue($value)) {
            throw new \Exception("This value is incorrect!");
        }

        $this->value = $value;
    }

    private static $consts = [];

    /**
     * @param $value
     * @param bool $strict
     * @return bool
     */
    public static function isValidValue($value, $strict = true)
    {
        $values = array_values(self::getAll());
        return in_array($value, $values, $strict);
    }

    /**
     * @param $name
     * @param bool $strict
     * @return bool
     */
    public static function isValidName($name, $strict = false)
    {
        $constants = self::getAll();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    /**
     * @param $value
     * @return mixed
     */
    public static function getName($value)
    {
        $constants = self::getAll();
        return array_search($value, $constants);
    }

    /**
     * @return mixed
     */
    public static function getAll()
    {
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$consts)) {
            $reflect = new \ReflectionClass($calledClass);
            self::$consts[$calledClass] = $reflect->getConstants();
        }
        return self::$consts[$calledClass];
    }

    public function __toString()
    {
        return "{$this->value}";
    }
}