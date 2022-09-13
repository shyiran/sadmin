<?php
declare (strict_types = 1);
// +----------------------------------------------------------------------
// | swiftAdmin 极速开发框架 [基于ThinkPHP6开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2020-2030 http://www.swiftadmin.net
// +----------------------------------------------------------------------
// | swiftAdmin.net High Speed Development Framework
// +----------------------------------------------------------------------
// | Author: meystack <coolsec@foxmail.com> Apache 2.0 License Code
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\HomeController;
use think\facade\Db;
use think\response\View;

class Index extends HomeController
{
    /**
     * 前端首页
     * @return View
     */
    public function index(): View
    {
        return $this->view();
    }

    /**
     * 前端演示
     * @return void
     */
    public function demo()
    {
        echo 'hello world';
    }
}
