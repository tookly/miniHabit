<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/5
 * Time: 下午4:49
 */

class Route
{
    public $controller;
    
    public $action;
    
    public static function onRoute($uri)
    {
        // todo route
        $controller = 'HabitController';
        $action = 'actionTarget';
        return array($controller, $action);
    }
    
//    private function getController($controller)
//    {
//        return 'HabitController';
//    }
//
//    private function getAction($action)
//    {
//        return 'actionTarget';
//    }
    
}