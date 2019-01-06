<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/5
 * Time: 下午4:12
 */

class BaseController
{
    public $request;
    
    public $response;
    
    public function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    
    public function run()
    {
    
    }
}