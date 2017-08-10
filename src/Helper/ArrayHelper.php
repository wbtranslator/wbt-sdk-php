<?php
declare(strict_types=1);

namespace WBTranslator\Sdk\Helper;

/**
 * Class ArrayHelper
 *
 * @package WBTranslator
 */
class ArrayHelper
{
    /**
     * Flatten a multi-dimensional associative array with dots.
     *
     * @param array $array
     * @param string $prepend
     * @return array
     */
    public static function dot($array, $prepend = '')
    {
        $results = [];
        
        foreach ($array as $key => $value) {
            if (is_array($value) && ! empty($value)) {
                $results = array_merge($results, static::dot($value, $prepend . $key . '.'));
            } else {
                $results[$prepend . $key] = $value;
            }
        }
        
        return $results;
    }
    
    /**
     * Set an array item to a given value using "dot" notation.
     *
     * If no key is given to the method, the entire array will be replaced.
     *
     * @param array $array
     * @param string $key
     * @param mixed $value
     * @return array
     */
    public static function set(&$array, $key, $value)
    {
        if (is_null($key)) {
            return $array = $value;
        }
        
        $keys = explode('.', $key);
        
        while (count($keys) > 1) {
            $key = array_shift($keys);
            
            if (!isset($array[$key]) || !is_array($array[$key])) {
                $array[$key] = [];
            }
            
            $array = &$array[$key];
        }
        
        $array[array_shift($keys)] = $value;
        
        return $array;
    }
    
    /**
     * Return the last element in an array.
     *
     * @param  array  $array
     * @return mixed
     */
    public static function last($array)
    {
        return empty($array) ? null : end($array);
    }
}