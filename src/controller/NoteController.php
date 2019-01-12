<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/5
 * Time: 下午4:09
 */
namespace controller;

class NoteController extends BaseController
{
    public function line()
    {
        $data = json_encode(['code' => 0, 'message' => 'success']);
        $this->response->end($data);
    }
}