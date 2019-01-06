<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/5
 * Time: 下午4:07
 */

require_once dirname(__FILE__) . '/core/Application.php';

define('APP_PATH', dirname(__FILE__));

return Application::create();