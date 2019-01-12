<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/5
 * Time: 下午12:14
 */

class HttpServer {
    
    public $httpServer;
    
    public $app;
    
    public function __construct()
    {
        $this->httpServer = new Swoole\Http\Server("127.0.0.1", 9501);
    }
    
    public function initServer()
    {
        $this->httpServer->on('Start', array($this, 'onMasterStart'));
        $this->httpServer->on('ManagerStart', array($this, 'onManagerStart'));
        $this->httpServer->on('WorkerStart', array($this, 'onWorkerStart'));
        $this->httpServer->on('Connect', array($this, 'onConnect'));
        $this->httpServer->on('Receive', array($this, 'onReceive'));
        $this->httpServer->on('Request', array($this, 'onRequest'));
        $this->httpServer->on('Close', array($this, 'onClose'));
        $this->httpServer->on('WorkerStop', array($this, 'onWorkerStop'));
    }
    
    public function start()
    {
        $this->httpServer->start();
    }
    
    public function onMasterStart()
    {
    
    }
    
    public function onManagerStart()
    {
    
    }
    
    public function onWorkerStart()
    {
        $this->app = (require dirname(__FILE__) . '/../index.php');
    }
    
    public function onConnect()
    {
    
    }
    
    public function onReceive()
    {
    
    }
    
    public function onRequest($request, $response)
    {
        $this->app->request = $request;
        $this->app->response = $response;
        $this->app->run();
    }
    
    public function onClose()
    {
    
    }
    
    public function onWorkerStop()
    {
    
    }
    
}

$httpServer = new HttpServer();
$httpServer->initServer();
$httpServer->start();
