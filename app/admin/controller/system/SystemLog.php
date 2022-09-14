<?php
declare (strict_types=1);

namespace app\admin\controller\system;

use app\AdminController;
use app\common\model\system\SystemLog as SystemLogModel;

/**
 * 系统日志
 * Class SystemLog
 * @package app\admin\controller\system
 */
class SystemLog extends AdminController
{
    // 初始化函数
    public function initialize ()
    {
        parent::initialize ();
        $this->model = new SystemLogModel();
    }

    /**
     * 获取资源列表
     */
    public function index ()
    {

        if (request ()->isAjax ()) {
            // 获取数据
            $post = input ();
            $page = input ('page/d') ?? 1;
            $limit = input ('limit/d') ?? 10;

            // 生成查询数据
            $where = array();
            if (!empty($post['name'])) {
                $where[] = [ 'url', 'like', '%' . $post['name'] . '%' ];
            }

            if (!empty($post['type']) && $post['type'] == 'user') {
                $where[] = [ 'name', '<>', 'system' ];
            } else if (!empty($post['type']) && $post['type'] == 'system') {
                $where[] = [ 'name', '=', 'system' ];
            }

            if (!empty($post['status']) && $post['status'] == 'normal') {
                $where[] = [ 'error', '=', null ];
            } else if (!empty($post['status']) && $post['status'] == 'error') {
                $where[] = [ 'error', '<>', '' ];
            }

            $where[] = [ 'status', '=', '1' ];
            $count = $this->model->where ($where)->count ();
            $page = ($count <= $limit) ? 1 : $page;
            $list = $this->model->where ($where)->order ('id', 'desc')
                ->limit ($limit)->page ($page)->select ()->toArray ();

            return $this->success ('查询成功', "", $list, $count);

        }

        return view ();
    }
}