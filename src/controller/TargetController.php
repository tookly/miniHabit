<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/5
 * Time: 下午4:09
 */

namespace controller;

use component\Redis;

class TargetController extends BaseController
{
    const TARGET_KEY = 'HASH:TARGET:%s';
    const TARGET_NOTE_KEY = 'LIST:TARGET:NOTE:%s';
    const TARGET_SIGN_KEY = 'ZSET:TARGET:SIGN:%s';
    
    /**
     * @throws \exception
     */
    public function info()
    {
        $targetId = $this->get('targetId');
        $data = Redis::instance()->hGetAll(sprintf(self::TARGET_KEY, $targetId)) ?: [];
        $this->sendSuccess($data);
    }
    
    /**
     * @throws \exception
     */
    public function set()
    {
        $data['target'] = $this->post('target');
        if (empty($data['target'])) {
            $this->sendParamErr();
        }
        $data['targetId'] = ($targetId = 1);
        Redis::instance()->hMSet(sprintf(self::TARGET_KEY, $targetId), $data);
        $this->sendSuccess($data);
    }
    
    /**
     * @throws \exception
     */
    public function notes()
    {
        $targetId = $this->get('targetId');
        $data['lines'] = Redis::instance()->lRange(sprintf(self::TARGET_NOTE_KEY, $targetId), 0, -1);
        $this->sendSuccess($data);
    }
    
    /**
     * @throws \exception
     */
    public function note()
    {
        $targetId = $this->post('targetId');
        $line = $this->post('line');
        if (empty($line)) {
            $this->sendParamErr();
        }
        Redis::instance()->rPush(sprintf(self::TARGET_NOTE_KEY, $targetId), $line);
        $this->sendSuccess();
    }
    
    /**
     * @throws \exception
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
        Redis::instance()->zIncrBy($signKey, $unit, $date);
        $this->sendSuccess();
    }
    
    public function statistics()
    {
        $targetId = $this->post('targetId');
    }
    
}
