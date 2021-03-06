<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/12
 * Time: 上午11:31
 */

class Request extends \Swoole\Http\Request
{
    public $source;
    
    public function __construct($request)
    {
        $this->source = $request;
        $data = get_object_vars($request);
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
    
}