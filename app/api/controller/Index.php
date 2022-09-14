<?php
declare (strict_types=1);

namespace app\api\controller;

use app\ApiController;

/**
 * API接口前端示例文件
 */
class Index extends ApiController
{
    // 首页展示
    public function index(): \think\response\Json
    {
        return json(['msg' => 'success', 'data' => 'Hello']);
    }

}
