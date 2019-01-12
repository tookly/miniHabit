<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/12
 * Time: 上午11:32
 */

class Response extends \Swoole\Http\Response
{
    /**
     * @var \Swoole\Http\Response
     */
    public $source;
    
    public function __construct($response)
    {
        $this->source = $response;
    }
    
    public function send($data)
    {
        $this->source->end(json_encode($data));
    }
    
}