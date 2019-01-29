<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/14
 * Time: 下午9:50
 */
namespace component;

use Code;

class Redis
{
    private static $config;
    
    private static $instance = [];
    
    private static $tryTimes;
    
    private static $tryTimesLimit = 100;
    
    public static function getConfig($name, array $config = [])
    {
        if (empty(self::$config[$name])) {
            self::$config = array_merge($config, Config::get('redis', []));
        }
        if (empty(self::$config[$name])) {
            throw new Exception(1,'config not exist');
        }
        return self::$config[$name];
    }
    
    /**
     * 假如redis服务挂了，就是连不上，这个是不是不合理？在connect这一步是不是就会报错？
     *
     * @param $name
     * @return mixed
     * @throws Exception
     */
    public static function instance($name = 'storage')
    {
        if (empty(self::$instance[$name])) {
            $config = self::getConfig($name);
            self::$instance[$name] = new \Redis();
            self::$instance[$name]->connect($config['host'], $config['port'], $config['timeout']);
//            self::$instance[$name]->auth($config['password']);
        } else {
            try {
                if (!(self::$instance[$name]->ping())) {
                    self::$instance[$name] = null;
                    return self::instance($name);
                }
            } catch (Exception $e) {
                self::$instance[$name] = null;
                return self::instance($name);
            }
        }
        return self::$instance[$name];
    }
    
}