<?php
///**
// * Created by PhpStorm.
// * User: chengxiaoli
// * Date: 2019/1/31
// * Time: 下午3:04
// */
//
//namespace controllerTest;
//
//use controller\TargetController;
//use PHPUnit\Framework\TestCase;
//
//class TargetControllerTest extends TestCase
//{
//    public $controller;
//
//    public function __construct(string $name = null, array $data = [], string $dataName = '')
//    {
//        require_once dirname(__FILE__) . '/../../vendor/autoload.php';
//        parent::__construct($name, $data, $dataName);
//        $this->controller = new TargetController();
//        $this->controller->request = new \Request();
//        $this->controller->response = new \Response();  // 如何屏蔽掉request、response，只剩逻辑部分呢？
//    }
//
//    public function setPost($query)
//    {
//        foreach ($query as $key => $value) {
//            $this->controller->setPost($key, $value);
//        }
//    }
//
//    public function setGet($body)
//    {
//        foreach ($body as $key => $value) {
//            $this->controller->setGet($key, $value);
//        }
//    }
//
//    public function getResponse()
//    {
//        return $this->controller->response->data;
//    }
//
//    public function testSet()
//    {
//        // 需要入参、出参，校验入参、出参和内部状态变化
//        $query['target'] = '每天晚上11点前入睡，早上7点前起床';
//        $query['targetId'] = -1;
//        $this->setGet($query);
//        $this->controller->set();
//        $res = $this->getResponse();
//        $this->assertTrue($res['code'], Code::SUCCESS());
//        $this->assertTrue(true);
//        return 1;
//    }
//
//    /**
//     * @depends testSet
//     * @dataProvider mockDataProvider
//     */
//    public function testInfo()
//    {
//        $args = func_get_args();
//        print_r($args);
//        $this->assertTrue(true);
//    }
//
//    public function mockDataProvider()
//    {
//        return [
//            [1,2,3],
//            [2,2,4],
//        ];
//    }
//
//}