<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/14
 * Time: 下午9:50
 */
namespace component;

use Code;
use Config;
use HabitException;
use Redis;

class RedisUtil
{
    private static $redisInstance;
    
    public static function getRedis()
    {
        if (self::$redisInstance == null) {
            $config = Config::getConfig('redis');
            self::$redisInstance = new Redis();
            self::$redisInstance->connect($config['host'], $config['port'], $config['timeout']);
        } else {
            try {
                if (!(self::$redisInstance->ping())) {
                    self::$redisInstance = null;
                    return self::getRedis();
                }
            } catch (\Exception $e) {
                self::$redisInstance = null;
                return self::getRedis();
            }
        }
        return self::$redisInstance;
    }
    
    /**
     * @param $command
     * @param $params
     * @return bool
     * @throws HabitException
     */
    public static function doRedis($command, $params)
    {
        $redisInstance = self::getRedis();
        if ($redisInstance == null) {
            throw new HabitException(Code::ERROR);
        } else {
            $ret = $redisInstance->$command(...$params);
        }
        return $ret ?? false;
    }
    
}