<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/5
 * Time: 下午4:09
 */
namespace controller;

class TargetController extends BaseController
{
    public function info()
    {
        $targetId = $this->request->get['targetId'];
        $data['targetId'] = $targetId;
        $this->sendSuccess($data);
    }
    
    public function set()
    {
        $data = json_encode(['code' => 0, 'message' => 'success']);
        $this->response->end($data);
    }
    
    public function note()
    {
    
    }
    
    public function sign()
    {
    
    }
    
    public function statistics()
    {
    
    }
    
}
