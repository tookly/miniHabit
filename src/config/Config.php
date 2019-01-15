<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/14
 * Time: 下午9:50
 */

class Config {
    
    public static $configs = [
        'redis' => [
            'host' => '127.0.0.1',
            'port' => '6379',
            'timeout' => 3
        ]
    ];
    
    public static function getConfig($key)
    {
        return self::$configs[$key] ?? [];
    }
    
}
