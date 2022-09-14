<?php
declare (strict_types=1);


namespace app\admin\middleware\system;

use app\admin\library\Auth;
use app\common\library\ResultCode;

class AdminGroup
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

        if (request()->isPost()) {

            $id = input('id');
            if (!empty($id) && $id >= 1) {
                if (!Auth::instance()->checkRulesForGroup((array)$id)) {
                    return json(ResultCode::AUTH_ERROR);
                }
            }
        }

        return $next($request);
    }

}