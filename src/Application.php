<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/5
 * Time: 下午4:46
 */

use Swoole\Coroutine;

class Application
{
    public $request;
    
    public $response;
    
    /**
     * @var FastRoute\Dispatcher\GroupCountBased
     */
    public static $dispatcher;
    
    /**
     * 初始化配置
     *
     * @return Application
     */
    public static function create()
    {
        self::$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
            $r->get('/flag/info', ['\controller\TargetController', 'info']);
        });
        return new self();
    }
    
    public function run()
    {
        $httpMethod = $this->request->server['request_method'];
        $uri = $this->request->server['request_uri'];
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        $routeInfo = self::$dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                throw new Exception(...Code::NOT_FOUND);
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                throw new Exception(...Code::NOT_FOUND);
            case FastRoute\Dispatcher::FOUND: // 找到对应的方法
                $handler = $routeInfo[1]; // 获得处理函数
                $vars = $routeInfo[2]; // 获取请求参数
                $controller = new $handler[0]($this->request, $this->response);
//                $controller->$handler[1]($vars);
                Coroutine::call_user_func(array($controller, $handler[1]), $vars);
                break;
        }
    }
    
}