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
        return $this->request->get[$key] ?? $default;
    }
    
    public function post($key, $default = null)
    {
        return $this->request->post[$key] ?? $default;
    }
    
    public function sendSuccess($data = [])
    {
        list($res['code'], $res['message']) = Code::SUCCESS;
        $res['data'] = $data;
        $this->response->send($res);
    }
    
    public function sendParamErr($data = [])
    {
        list($res['code'], $res['message']) = Code::ERROR_PARAMS;
        $res['data'] = $data;
        $this->response->send($res);
    }
    
}