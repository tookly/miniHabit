<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/12
 * Time: 上午11:32
 */

class Response extends \Swoole\Http\Response
{
    public function __construct($response)
    {
        $data = get_object_vars($response);
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}