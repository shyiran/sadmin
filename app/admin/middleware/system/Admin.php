<?php
declare (strict_types=1);


namespace app\admin\middleware\system;

use app\admin\library\Auth;
use app\common\library\ResultCode;
use app\common\model\system\Admin as AdminModel;
use think\Request;

class Admin
{
    /**
     * 处理请求
     *
     * @param $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if ($request->isPost()) {

            $id = input('id/s');
            if ($data = AdminModel::getById($id)) {
                $group_id = input('group_id/s');
                $group_id = !empty($group_id) ? $group_id . ',' . $data['group_id'] : $data['group_id'];
                $group_id = array_unique(explode(',', $group_id));
                if (!Auth::instance()->checkRulesForGroup($group_id)) {
                    return json(ResultCode::AUTH_ERROR);
                }
            }
        }

        return $next($request);
    }

}