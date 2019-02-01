<?php
/**
 * Created by PhpStorm.
 * User: chengxiaoli
 * Date: 2019/1/12
 * Time: 上午11:20
 */

namespace component;

// 如何才能在一起编辑code和mesage，但是使用的时候还是只用code就ok了呢? 名字服务
// code还是定义在一起，方便查找
// message还是要定义一下，方便复用
// 支持自定义code
// 那就变成了用一种方法，可以获取int或array，这种方法最好是Code::ERROR这样子，可能吗？
// 翻转过来，就是如何方便的定义，int给判断使用，array是throw exception使用。
// 假如业务内失败，都扔failed会有混淆
// 在业务内只需要关心code，不需要关心message，但是支持自定义的message，定义的时候较为麻烦

class Code {
    
    # -1 undefined error
    const ERROR = [-1, 'undefined failed'];
    
    # 0-1000 system error
    const SUCCESS = [0, 'success'];
    const NOT_FOUND = [404, 'not fount'];
    const METHOD_NOT_ALLOWED = [405, 'method not allowed'];
    
    # 1001-10000 business error
    const ERROR_BUSINESS= [1001];
    const ERROR_PARAMS = [1002, 'params error'];
    
    # 10000- internal error
    
};
