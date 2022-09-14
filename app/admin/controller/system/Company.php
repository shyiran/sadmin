<?php
declare (strict_types = 1);

namespace app\admin\controller\system;


use app\AdminController;
use app\common\model\system\Company as CompanyModel;

/**
 * 公司信息
 * Class Company
 * @package app\admin\controller\system
 */
class Company extends AdminController 
{
   
    // 初始化函数
    public function initialize() 
    {
        parent::initialize();
        $this->model = new CompanyModel();
    }

    /**
     * 获取资源列表
     */
    public function index()
    {
        if (request()->isAjax()) {

            // 生成查询条件
            $post = input();
            $where = array();
            if (!empty($post['title'])) {
                $where[] = ['title','like','%'.$post['title'].'%'];
            }

            // 生成查询数据
            $list = $this->model->where($where)->select()->toArray();
            return $this->success('查询成功', null, $list, count($list));
        }

		return view();
    }

    /**
     * 添加公司信息
     */
    public function add () 
    {
		if (request()->isPost()) {

			$post = input('post.');
            $post = post_validate_rules($post,get_class($this->model));
            if (empty($post) || !is_array($post)) {
                $this->error($post);
            }
            
            if ($this->model->create($post)){
                return $this->success();
            }

            return $this->error();
        }
 
        return view('',[
            'data'=> $this->getTableFields()
        ]);
    }

    /**
     * 编辑公司信息
     */
    public function edit() 
    {
        $id = input('id/d');
        if (request()->isPost()) {
            $post = input('post.');
            $post = post_validate_rules($post,get_class($this->model));
            if (empty($post) || !is_array($post)) {
                $this->error($post);
            }

            if ($this->model->update($post)){
                return $this->success();
            }
            return $this->error();
        }

        $data = $this->model->find($id);
        return view('add',['data'=> $data]);
    }

}   