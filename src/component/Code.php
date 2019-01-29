<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/12
 * Time: 上午11:20
 */

class Code {
    # -1 undefined error
    const ERROR = [-1, 'failed'];
    
    # 0-1000 system error
    const SUCCESS = [0, 'success'];
    const NOT_FOUND = [404, 'not fount'];
    const METHOD_NOT_ALLOWED = [405, 'method not allowed'];
    
    # 1001-10000 logic error
    const ERROR_PARAMS = [10001, 'params error'];
    
    # 10000- internal error
    
};
