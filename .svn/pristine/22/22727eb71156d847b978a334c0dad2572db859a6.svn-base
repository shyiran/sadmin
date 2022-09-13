<?php

declare(strict_types=1);
// +----------------------------------------------------------------------
// | swiftAdmin 极速开发框架 [基于ThinkPHP6开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2020-2030 http://www.swiftadmin.net
// +----------------------------------------------------------------------
// | swiftAdmin.net High Speed Development Framework
// +----------------------------------------------------------------------
// | Author: meystack <coolsec@foxmail.com> Apache 2.0 License Code
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\AdminController;
use app\common\model\system\Admin;
use app\common\model\system\LoginLog;
use think\facade\Event;
use think\facade\Session;

/**
 * 登录控制器
 * Class Login
 * @package app\admin\controller
 */
class Login extends AdminController
{
    protected function initialize()
    {
        $this->admin = Session::get($this->sename);
        $this->model = new Admin();
        $this->JumpUrl = request()->baseFile();
    }

    /**
     * 管理员登录
     */
    public function index()
    {
        if (request()->isPost()) {

            // 用户信息
            $user = input('post.name');
            $pwd = input('post.pwd');
            $captcha = input('post.captcha');

            // 错误次数
            if ((isset($this->admin['count'])
                    && $this->admin['count'] >= 5)
                && (isset($this->admin['time'])
                    && $this->admin['time'] >= strtotime('- 5 minutes'))
            ) {
                $error = '错误次数过多，请稍后再试！';
                $this->writeSystemLoginLog($error);
                return $this->error($error);
            }

            // 验证码
            if (isset($this->admin['isCaptcha'])) {
                if (!$captcha || !captcha_check($captcha)) {
                    $error = '验证码错误！';
                    $this->writeSystemLoginLog($error);
                    return $this->error($error);
                }
            }

            // 验证表单令牌
            if (!request()->checkToken('__token__')) {
                $token = request()->buildToken('__token__');
                $error = '表单令牌错误！';
                $this->writeSystemLoginLog($error);
                return $this->error($error, '', ['token' => $token]);
            } else {

                $result = Admin::checkLogin($user, $pwd);
                if (empty($result)) {
                    $this->admin['time'] = time();
                    $this->admin['isCaptcha'] = true;
                    $this->admin['count'] = isset($this->admin['count']) ? $this->admin['count'] + 1 : 1;
                    Session::set($this->sename, $this->admin);
                    $error = '用户名或密码错误！';
                    $this->writeSystemLoginLog($error);
                    Event::trigger('admin_login_error', input('post.'));
                    return $this->error($error, '', ['token' => request()->buildToken('__token__')]);
                }

                if ($result['status'] !== 1) {
                    $error = '账号已被禁用！';
                    $this->writeSystemLoginLog($error);
                    return $this->error($error);
                }

                $result->login_ip = request()->ip();
                $result->login_time = time();
                $result->count = $result->count + 1;

                try {

                    $result->save();
                    Session::set($this->sename, $result->toArray());
                } catch (\Throwable $th) {
                    return $this->error($th->getMessage());
                }

                $success = '登录成功！';
                $this->writeSystemLoginLog($success, true);
                Event::trigger('admin_login_success', input('post.'));
                return $this->success($success, $this->JumpUrl);
            }
        }

        return view('', [
            'captcha' => $this->admin['isCaptcha'] ?? false,
        ]);
    }

    /**
     * 写入登录日志
     */
    public function writeSystemLoginLog(string $error, $status = 0)
    {

        $name = input('post.name');
        $userAgent = request()->server('HTTP_USER_AGENT');
        $nickname = $this->model->where('name', $name)->value('nickname');
        if (preg_match('/.*?\((.*?)\).*?/', $userAgent, $matches)) {
            $user_os = substr($matches[1], 0, strpos($matches[1], ';'));
        } else {
            $user_os = '未知';
        }

        $user_browser = preg_replace('/[^(]+\((.*?)[^)]+\) .*?/','$1',$userAgent);

        $data = [
            'user_ip'      => request()->ip(),
            'user_agent'   => $userAgent,
            'user_os'      => $user_os,
            'user_browser' => $user_browser,
            'name'         => $name,
            'nickname'     => $nickname ?? '未知',
            'error'        => $error,
            'status'       => $status,
        ];

        LoginLog::create($data);
    }

    /**
     * 管理员退出
     */
    public function logout()
    {
        \think\facade\Session::clear($this->sename);
        $this->success('退出成功！', $this->JumpUrl);
    }

    /**
     * 管理员注册
     * 为了安全
     * 移除的后台注册代码
     * 如果有需求请自行实现逻辑
     */
    public function register()
    {
        $this->throwError('error', 403);
    }

    /**
     * 找回密码
     */
    public function forgot()
    {
        $this->throwError('error', 403);
    }
}
