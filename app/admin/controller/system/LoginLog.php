<?php
declare (strict_types=1);

namespace app\admin\controller\system;

use app\AdminController;
use app\common\model\system\LoginLog as LoginLogModel;

/**
 * login_log
 * 登录日志
 * @author  meystack <
 * @version 1.0
 */
class LoginLog extends AdminController
{
    /**
     * LoginLog模型对象
     * @var LoginLogModel
     */

    public $tplSharing = 'add';

    public function initialize ()
    {
        parent::initialize ();
        $this->model = new LoginLogModel;
    }

    /**
     * 默认生成的方法为index/add/edit/del/status 五个方法
     * 当创建CURD的时候，DIY的函数体和模板为空，请自行编写代码
     */


}
