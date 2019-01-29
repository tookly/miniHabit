<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2017/11/20
 * Time: 下午8:04
 */

namespace component;

class Config {
    /**
     * @var array
     */
    private static $i = [];
    
    /**
     * @param array $config
     * @throws
     */
    public static function init(array $config)
    {
        self::$i = self::object2array($config);
        if (empty($config['env'])) {
            throw new Exception(1,"env config error");
        }
    }
    
    public static function instance() {
        return self::$i;
    }
    
    /**
     * @param $k
     * @return array|mixed
     * @internal param $k
     */
    public static function get($k, $default = null) {
        return self::$i[$k] ?? $default;
    }
    
    /**
     * @param $k
     * @param $v
     * @return void
     */
    public static function set($k, $v) {
        if (empty(self::$i[$k])) {
            self::$i[$k] = $v;
        }
    }
    
    public static function object2array($obj) {
        $obj = (array)$obj;
        foreach ($obj as $k => $v) {
            if (gettype($v) == 'resource') {
                return;
            }
            if (gettype($v) == 'object' || gettype($v) == 'array') {
                $obj[$k] = (array)self::object2array($v);
            }
        }
        return $obj;
    }
    
}