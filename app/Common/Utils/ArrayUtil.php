<?php

namespace App\Common\Utils;

class ArrayUtil
{
    /**
     * 根据键值获取数组中的值
     * @param array $array
     * @param $key
     * @param $default
     * @return mixed
     */
    public static function get(array $array, $key, $default)
    {
        if (isset($array[$key])) {
            return $array[$key];
        } else {
            return $default;
        }
    }

    /**
     * @param array $array
     * @param $columnName
     * @return array
     */
    public static function column(array $array, $columnName)
    {
        if (function_exists('array_column')) {
            return array_column($array, $columnName);
        }

        if (empty($array)) {
            return array();
        }

        $column = array();

        foreach ($array as $item) {
            if (isset($item[$columnName])) {
                $column[] = $item[$columnName];
            }
        }

        return $column;
    }

    /**
     * @param array $array
     * @param array $columnNames
     * @return array
     */
    public static function columns(array $array, array $columnNames)
    {
        if (empty($array) or empty($columnNames)) {
            return array();
        }

        $columns = array();

        foreach ($array as $item) {
            foreach ($columnNames as $key) {
                $value = isset($item[$key]) ? $item[$key] : '';
                $columns[$key][] = $value;
            }
        }

        return array_values($columns);
    }

    /**
     * @param array $array
     * @param array $keys
     * @return array
     */
    public static function parts(array $array, array $keys)
    {
        foreach (array_keys($array) as $key) {
            if (!in_array($key, $keys)) {
                unset($array[$key]);
            }
        }

        return $array;
    }

    /**
     * @param array $array
     * @param array $keys
     * @param bool $strictMode
     * @return bool
     */
    public static function requireds(array $array, array $keys, $strictMode = false)
    {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $array)) {
                return false;
            }
            if ($strictMode && (is_null($array[$key]) || '' === $array[$key] || 0 === $array[$key])) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $before
     * @param array $after
     * @return array
     */
    public static function changes(array $before, array $after)
    {
        $changes = array('before' => array(), 'after' => array());

        foreach ($after as $key => $value) {
            if (!isset($before[$key])) {
                continue;
            }

            if ($value != $before[$key]) {
                $changes['before'][$key] = $before[$key];
                $changes['after'][$key] = $value;
            }
        }

        return $changes;
    }

    /**
     * @param array $array
     * @param $key
     * @return array
     */
    public static function group(array $array, $key)
    {
        $grouped = array();

        foreach ($array as $item) {
            if (empty($grouped[$item[$key]])) {
                $grouped[$item[$key]] = array();
            }

            $grouped[$item[$key]][] = $item;
        }

        return $grouped;
    }

    /**
     * 将数组中的某一个键值的value作为数组的下标
     * @param array $array
     * @param $name
     * @return array
     */
    public static function index(array $array, $name)
    {
        $indexedArray = array();

        if (empty($array)) {
            return $indexedArray;
        }

        foreach ($array as $item) {
            if (isset($item[$name])) {
                $indexedArray[$item[$name]] = $item;
                continue;
            }
        }

        return $indexedArray;
    }

    /**
     * @param array $array
     * @param $key
     * @param $index
     * @return array
     */
    public static function groupIndex(array $array, $key, $index)
    {
        $grouped = array();

        foreach ($array as $item) {
            if (empty($grouped[$item[$key]])) {
                $grouped[$item[$key]] = array();
            }

            $grouped[$item[$key]][$item[$index]] = $item;
        }

        return $grouped;
    }

    /**
     * @param array $array
     * @param array $map
     * @return array
     */
    public static function rename(array $array, array $map)
    {
        $keys = array_keys($map);

        foreach ($array as $key => $value) {
            if (in_array($key, $keys)) {
                $array[$map[$key]] = $value;
                unset($array[$key]);
            }
        }

        return $array;
    }

    /**
     * @param array $array
     * @param array $specialValues
     * @return array
     */
    public static function filter(array $array, array $specialValues)
    {
        $filtered = array();

        foreach ($specialValues as $key => $value) {
            if (!array_key_exists($key, $array)) {
                continue;
            }

            if (is_array($value)) {
                $filtered[$key] = (array) $array[$key];
            } elseif (is_int($value)) {
                $filtered[$key] = (int) $array[$key];
            } elseif (is_float($value)) {
                $filtered[$key] = (float) $array[$key];
            } elseif (is_bool($value)) {
                $filtered[$key] = (bool) $array[$key];
            } else {
                $filtered[$key] = (string) $array[$key];
            }

            if (!isset($filtered[$key])) {
                $filtered[$key] = $value;
            }
        }

        return $filtered;
    }

    /**
     * @param $array
     * @return array
     */
    public static function trim($array)
    {
        if (!is_array($array)) {
            return $array;
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = static::trim($value);
            } elseif (is_string($value)) {
                $array[$key] = trim($value);
            }
        }

        return $array;
    }

    /**
     * @param $array
     * @param null $callback
     * @return bool
     */
    public static function every($array, $callback = null)
    {
        foreach ($array as $value) {
            if ((is_null($callback) && !$value) || (is_callable($callback) && !$callback($value))) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param $array
     * @param null $callback
     * @return bool
     */
    public static function some($array, $callback = null)
    {
        foreach ($array as $value) {
            if ((is_null($callback) && $value) || (is_callable($callback) && $callback($value))) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $doubleArrays
     * @return array
     */
    public static function mergeArraysValue($doubleArrays)
    {
        $values = array();
        foreach ($doubleArrays as $array) {
            if (empty($array)) {
                continue;
            }
            foreach ($array as $value) {
                if (in_array($value, $values)) {
                    continue;
                }
                $values[] = $value;
            }
        }

        return $values;
    }

    /**
     * @param array $array
     * @param array $columns
     * @return array
     */
    public static function thin(array $array, array $columns)
    {
        $thinner = array();
        foreach ($array as $k => $v) {
            foreach ($columns as $v2) {
                $thinner[$k][$v2] = $v[$v2];
            }
        }

        unset($array);

        return $thinner;
    }

    /**
     * 给数组中的所有key加上前缀
     * @param $array
     * @param $prefix
     * @return array
     */
    public static function appendKeyPrefix($array, $prefix)
    {
        $result = array();
        foreach ($array as $key => $value) {
            $result[$prefix.$key] = $value;
        }

        return $result;
    }

    /**
     * 根据$orderBy数组的值排序$array
     * 如 $array 为
     *  array(
     *      1 => array(a,b,c),
     *      2 => array(d,e,f),
     *      3 => array(g,h,i)
     *  )
     *
     * $orderArray = array(3,1,2)
     * 排完序后
     * array(3 => array(g,h,i), 1 => array(a,b,c), 3 => array(d,e,f))
     * @param $array
     * @param $orderArray
     * @return array
     */
    public static function orderByArray($array, $orderArray)
    {
        $keys = array_keys($array);
        $diffs1 = array_diff($orderArray, $keys);
        $diffs2 = array_diff($keys, $orderArray);
        if (count($keys) != count($orderArray) || count($diffs1) > 0 || count($diffs2) > 0) {
            return $array;
        }

        return array_replace(array_flip($orderArray), $array);
    }

    /**
     * 根据所给的二维数组进行排序, 按照二维数组内的指定属性排序
     *
     * @param $arr
     * @param $attrName
     * @param $ascending
     *
     * $arr 必须为二维数据
     * $attrName 二维数组内指定的属性
     * $ascending  默认为升序
     *
     * @return array
     *               如$arr 为
     *               array(
     *               array('id' => 1, 'name' => 'hello1'),
     *               array('id' => 2, 'name' => 'hello2'),
     *               )
     *
     *  $attrName 为 name, $ascending = false
     *
     *  排完序后结果为 array(
     *      array('id' => 2, 'name' => 'hello2'),
     *      array('id' => 1, 'name' => 'hello1'),
     *  )
     */
    public static function sortPerArrayValue($arr, $attrName, $ascending = true)
    {
        usort(
            $arr,
            function ($first, $next) use ($ascending, $attrName) {
                if ($ascending) {
                    return $first[$attrName] > $next[$attrName] ? 1 : -1;
                } else {
                    return $first[$attrName] < $next[$attrName] ? 1 : -1;
                }
            }
        );

        return $arr;
    }

    /**
     * 判断2个数组，是否值是相同的 （不同key, 相同value视为相同）
     * @param $arr1
     * @param $arr2
     * @return bool
     */
    public static function isSameValues($arr1, $arr2)
    {
        sort($arr1);
        sort($arr2);

        return $arr1 == $arr2;
    }

    /**
     * @param $array
     * @param $position
     * @param $insertArray
     * @return array
     */
    public static function insert($array, $position, $insertArray)
    {
        $firstArray = array_splice($array, 0, $position);
        $array = array_merge($firstArray, $insertArray, $array);

        return $array;
    }
}
