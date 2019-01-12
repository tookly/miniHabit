<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/12
 * Time: 下午3:12
 */

class HabitException extends Exception
{
    
    public function __construct($code, $message = '')
    {
        if (is_array($code)) {
            $code = $code[0];
            $message = $message ? $code[1] . '(' . $message . ')' : $code[1];
        }
        parent::__construct($message, $code);
    }
    
}
