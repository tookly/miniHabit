<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/31
 * Time: 下午3:04
 */

namespace controllerTest;

require_once dirname(__FILE__) . '/../../vendor/autoload.php';

use component\Code;
use PHPUnit\Framework\TestCase;

class TargetControllerTest extends TestCase
{
    public $host;
    
    public $connectTimeOut;
    
    public $timeOut;
    
    public function setUp()
    {
        $this->host = 'http://127.0.0.1:9501';
        $this->connectTimeOut = 3000;
        $this->timeOut = 5000;
    }
    
    public function testSet()
    {
        // 需要入参、出参，校验入参、出参和内部状态变化
        $query['target'] = '每天写50个字';
        $query['targetId'] = 1;
        $res = $this->post('/target/set', $query);
        $this->assertEquals($res['code'], Code::SUCCESS[0]);
    }
    
    /**
     * @depends testSet
     */
    public function testInfo()
    {
        $query['targetId'] = 1;
        $res = $this->get('/target/info', $query);
        $this->assertEquals('每天写50个字', $res['data']['target']);
    }
    
    public function tearDown()
    {
//        exec("cd /Users/chengxiaoli/Documents/wcworkspace/miniHabit & pm2 stop pm2_local.json");
    }
    
    public function get($path, $data = [])
    {
        $url = $this->host . $path;
        if (!empty($data)) {
            $query = http_build_query($data);
            $url = $url . '?' . $query;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $this->connectTimeOut);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $this->timeOut);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_ENCODING, '');
        $body = curl_exec($ch);
        $no = curl_errno($ch);
        if ($no !== 0) {
            $error = curl_error($ch);
            echo 'get ' . $url . ' error, error no : ' . $no . ', error : ' . $error . PHP_EOL;
        }
        curl_close($ch);
        return $body ? json_decode($body, true) : [];
    }
    
    public function post($path, $data = [], $header = false)
    {
        $url = $this->host . $path;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $this->connectTimeOut);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $this->timeOut);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, $header);
        $body = curl_exec($ch);
        $no = curl_errno($ch);
        if ($no !== 0) {
            $error = curl_error($ch);
            echo 'post ' . $url . ' error, error no : ' . $no . ', error : ' . $error . PHP_EOL;
        }
        curl_close($ch);
        return $body ? json_decode($body, true) : [];
    }
    
}