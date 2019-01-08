<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/5
 * Time: 下午4:09
 */
namespace controller;

class HabitController extends BaseController
{
    public function actionTarget()
    {
        $data = json_encode(['code' => 0, 'message' => 'success']);
        $this->response->end($data);
    }
    
    public function actionSign()
    {
    
    }
    
    public function actionNote()
    {
    
    }
    
    public function actionStatistic()
    {
    
    }

}