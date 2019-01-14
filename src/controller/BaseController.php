<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/5
 * Time: 下午4:12
 */
namespace controller;

use Code;

class BaseController
{
    /**
     * @var \Request
     */
    public $request;
    
    /**
     * @var \Response
     */
    public $response;
    
    public function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    
    public function get($key, $default = null)
    {
        $this->request->get['targetId'];
    }
    
    public function post($key, $default = null)
    {
    
    }
    
    public function sendSuccess($data)
    {
        $res['code'] = Code::SUCCESS;
        $res['message'] = 'success';
        $res['data'] = $data;
        $this->response->send($res);
    }
    
}