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
    
    public static function create()
    {
        return new self();
    }
    
    public function run()
    {
        require_once dirname(__FILE__) . '/Route.php';
        require_once dirname(__FILE__) . '/../controller/HabitController.php';
        
        $uri = $this->request->server['request_uri'];
        list($controller, $action) = Route::onRoute($uri);
        $class = new $controller($this->request, $this->response);
        $class->$action();
    }
}