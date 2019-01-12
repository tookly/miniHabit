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
            $r->get('/target/info', ['\controller\TargetController', 'info']);
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
        try {
            $routeInfo = self::$dispatcher->dispatch($httpMethod, $uri);
            switch ($routeInfo[0]) {
                case FastRoute\Dispatcher::NOT_FOUND:
                    throw new HabitException(Code::NOT_FOUND);
                    break;
                case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                    $allowedMethods = $routeInfo[1];
                    throw new HabitException(Code::METHOD_NOT_ALLOWED);
                    break;
                case FastRoute\Dispatcher::FOUND: // 找到对应的方法
                    list($controller, $action) = $routeInfo[1]; // 获得处理函数
                    var_dump($controller);
                    $vars = $routeInfo[2]; // 获取请求参数
                    var_dump($vars);
                    $controller = new $controller($this->request, $this->response);
                    $controller->$action($vars);
//                    Coroutine::call_user_func(array($controller, $handler[1]), $vars);  这个方法不存在？？
                    break;
            }
        } catch (\Exception $e) {
            $data = json_encode(['code' => $e->getCode(), 'message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            $this->response->send($data);
        }

    }
    
}