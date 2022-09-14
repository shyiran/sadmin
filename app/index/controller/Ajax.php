<?php
declare (strict_types = 1);


namespace app\index\controller;

use app\HomeController;

/**
 * Ajax控制器
 * @ 异步调用
 */
class Ajax extends HomeController
{
    /**
     * 首页
     */
    public function index()
    {
        throw new \Exception('请求错误', 404);
    }
}
