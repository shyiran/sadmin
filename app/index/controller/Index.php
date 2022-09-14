<?php
declare (strict_types=1);

namespace app\index\controller;

use app\HomeController;
use think\response\View;

class Index extends HomeController
{
    /**
     * 前端首页
     * @return View
     */
    public function index (): View
    {
        return $this->view ();
    }

    /**
     * 前端演示
     * @return void
     */
    public function demo ()
    {
        echo 'hello world';
    }
}
