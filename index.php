<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/5
 * Time: 下午4:07
 */

require_once dirname(__FILE__) . '/vendor/autoload.php';

define('APP_PATH', dirname(__FILE__));
define('APP_ENV', getenv('ENV'));

return Application::create();