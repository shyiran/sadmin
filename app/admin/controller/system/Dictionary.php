<?php
declare (strict_types = 1);

namespace app\admin\controller\system;

use app\AdminController;
use app\common\model\system\Dictionary as DictionaryModel;

/**
 * 字典管理
 * Class Dictionary
 * @package app\admin\controller\system
 */
class Dictionary extends AdminController
{

    public function initialize() 
    {
		parent::initialize();
        $this->model = new DictionaryModel();
    }
    
    public function index() 
    {
        $post = input();
        $pid = input('pid'); 
        $limit = input('limit/d') ?? 10;
        $page = input('page/d') ?? 1;
        if ($pid == null) {
            $pid = (string)$this->model->minId();
        } 

        if (request()->isAjax()) {

            // 生成查询数据
            $pid = !strstr($pid,',') ? $pid : explode(',',$pid);
            $where[] = ['pid','in',$pid];
            if (!empty($post['name'])) {
                $where[] = ['name','like','%'.$post['name'].'%'];
            }

            $count = $this->model->where($where)->count();
            $list = $this->model->where($where)->limit($limit)->page($page)->select()
                ->each(function($item,$key) use ($pid){
                if ($key == 0 && $pid == '0') {
                    $item['LAY_CHECKED'] = true;
                }

                return $item;
            });

            return $this->success('查询成功', null, $list, $count);
        }

        return view('',[ 'pid' => $pid]);
    }
}
