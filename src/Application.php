<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/5
 * Time: 下午4:46
 */

class Application
{
    public $request;
    
    public $response;
    
    /**
     * 初始化配置
     *
     * @return Application
     */
    public static function create()
    {
        return new self();
    }
    
    public function run()
    {
        $uri = $this->request->server['request_uri'];
        list($controller, $action) = Route::onRoute($uri);
        $class = new $controller($this->request, $this->response);
        $class->$action();
    }
    
}