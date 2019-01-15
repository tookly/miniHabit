<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/5
 * Time: 下午4:09
 */
namespace controller;

use component\RedisUtil;

class TargetController extends BaseController
{
    const TARGET_KEY = 'HASH:TARGET:%s';
    const TARGET_NOTE_KEY = 'LIST:TARGET:NOTE:%s';
    const TARGET_SIGN_KEY = 'ZSET:TARGET:SIGN:%s';
    
    /**
     * @throws \HabitException
     */
    public function info()
    {
        $targetId = $this->get('targetId');
        $data = RedisUtil::doRedis('hGetAll', [self::TARGET_KEY.$targetId]) ?: [];
        $this->sendSuccess($data);
    }
    
    /**
     * @throws \HabitException
     */
    public function set()
    {
        $data['target'] = $this->post('target');
        if (empty($data['target'])) {
            $this->sendParamErr();
        }
        $data['targetId'] = ($targetId = 1);
        RedisUtil::doRedis('hMSet', [self::TARGET_KEY.$targetId, $data]);
        $this->sendSuccess($data);
    }
    
    /**
     * @throws \HabitException
     */
    public function notes()
    {
        $targetId = $this->post('targetId');
        $data['lines'] = RedisUtil::doRedis('lRange', [self::TARGET_NOTE_KEY.$targetId, 0, -1]);
        $this->sendSuccess($data);
    }
    
    /**
     * @throws \HabitException
     */
    public function note()
    {
        $targetId = $this->post('targetId');
        $line = $this->post('line');
        if (empty($line)) {
            $this->sendParamErr();
        }
        RedisUtil::doRedis('rPush', [self::TARGET_NOTE_KEY.$targetId, $line]);
        $this->sendSuccess();
    }
    
    /**
     * @throws \HabitException
     */
    public function sign()
    {
        $targetId = $this->post('targetId');
        $unit = $this->post('unit');
        if (empty($line)) {
            $this->sendParamErr();
        }
        $signKey = sprintf(self::TARGET_SIGN_KEY, $targetId);
        $date = date('Ymd', time());
        RedisUtil::doRedis('zIncrBy', [$signKey, $unit, $date]);
        $this->sendSuccess();
    }
    
    public function statistics()
    {
    
    }
    
}
