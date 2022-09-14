<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\AdminController;
use app\common\library\Upload;

/**
 * Ajax类
 * Class Ajax
 * @package app\admin\controller
 */
class Ajax extends AdminController
{
    public function initialize ()
    {
        parent::initialize ();
    }

    /**
     * @return mixed|\think\response\View
     */
    public function index ()
    {
        return $this->success ();
    }

    /**
     * 文件上传
     * @return mixed|\think\response\Json|void
     * @throws \Exception
     */
    public function upload ()
    {
        if (request ()->isPost ()) {
            try {
                $uploadFiles = Upload::instance ()->upload ();
            } catch (\Throwable $th) {
                return $this->error (Upload::instance ()->getError () ?: $th->getMessage ());
            }
            if (!empty($uploadFiles)) {
                return json ($uploadFiles);
            }
        }
        $this->throwError ();
    }

    /**
     * 远程下载图片
     * @return mixed|\think\response\Json|void
     */
    public function getImage ()
    {
        if (request ()->isPost ()) {
            try {
                $uploadFiles = Upload::instance ()->download (input ('url'));
            } catch (\Throwable $th) {
                return $this->error (Upload::instance ()->getError () ?: $th->getMessage ());
            }
            if (!empty($uploadFiles)) {
                return json ($uploadFiles);
            }
        }
        $this->throwError ();
    }
}
