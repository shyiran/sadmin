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
namespace app\common\library;

use system\Random;
use app\common\model\system\User as UserModel;
use think\facade\Cache;
use think\facade\Event;
use think\facade\Request;

class Auth
{
    /**
     * token令牌
     * @var string
     */
    public $token = null;

    /**
     * 用户数据
     * @var object|array
     */
    public $userInfo = null;

    /**
     * 保活时间
     * @var string
     */
    protected $keepTime = 604800;

    /**
     * 错误信息
     * @var string
     */
    protected $_error = '';

    /**
     * @var object 对象实例
     */
    protected static $instance = null;

    /**
     * @var object
     */
    public $request;

    /**
     * 类构造函数
     * class constructor.
     */
    public function __construct($config = [])
    {
        $this->request = Request::instance();
        $this->keepTime = config('cookie.expire');
    }

    /**
     * 初始化
     * @access public
     * @param array $options 参数
     * @return object
     */
    public static function instance(array $options = [])
    {
        if (is_null(self::$instance)) {
            self::$instance = new static($options);
        }

        // 返回实例
        return self::$instance;
    }

    /**
     * 用户注册
     * @param array $post
     * @return UserModel|array|false|object|\think\Model|void|null
     */
    public function register(array $post)
    {
        if (!saenv('user_status')) {
            $this->setError('暂未开放注册！');
            return;
        }

        /**
         * 禁止批量注册
         */
        $where[] = ['create_ip', '=', ip2long(request()->ip())];
        $where[] = ['create_time', '>', linux_extime(1)];
        $totalMax = UserModel::where($where)->count();

        if ($totalMax >= saenv('user_register_second')) {
            $this->setError('当日注册量已达到上限');
            return;
        }

        // 过滤用户信息
        if (isset($post['nickname']) && UserModel::getByNickname($post['nickname'])) {
            $this->setError('当前用户名已被占用！');
            return;
        }

        if (isset($post['email']) && UserModel::getByEmail($post['email'])) {
            $this->setError('当前邮箱已被占用！');
            return;
        }

        if (isset($post['mobile']) && UserModel::getByMobile($post['mobile'])) {
            $this->setError('当前手机号已被占用！');
            return;
        }

        try {
            /**
             * 是否存在邀请注册
             */
            $post['invite_id'] = $this->getToken('inviter');
            if (isset($post['pwd']) && $post['pwd']) {
                $post['salt'] = Random::alpha();
                $post['pwd'] = encryptPwd($post['pwd'], $post['salt']);
            }

            $this->userInfo = UserModel::create($post);
            $this->responseToken($this->userInfo);

        } catch (\Throwable $th) {
            $this->setError($th->getMessage());
            return false;
        }

        return $this->userInfo;
    }

    /**
     * 用户检测登录
     * @param string $nickname
     * @param string $pwd
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function login(string $nickname = '', string $pwd = ''): bool
    {
        // 支持邮箱或手机登录
        if (filter_var($nickname, FILTER_VALIDATE_EMAIL)) {
            $where[] = ['email', '=', htmlspecialchars(trim($nickname))];
        } else {
            $where[] = ['mobile', '=', htmlspecialchars(trim($nickname))];
        }
        $this->userInfo = UserModel::where($where)->find();
        if (!empty($this->userInfo)) {

            $uPwd = encryptPwd($pwd, $this->userInfo['salt']);
            if ($this->userInfo['pwd'] !== $uPwd) {
                $this->setError('用户名或密码错误');
                return false;
            }

            if (!$this->userInfo['status']) {
                $this->setError('用户异常或未审核，请联系管理员');
                return false;
            }

            // 更新登录数据
            $userUpdate = [
                'id'          => $this->userInfo['id'],
                'login_time'  => time(),
                'login_ip'    => request()->ip(),
                'login_count' => $this->userInfo['login_count'] + 1,
            ];

            if (UserModel::update($userUpdate)) {
                $this->responseToken($this->userInfo);
                return true;
            }
        }

        $this->setError('您登录的用户不存在');
        return false;
    }

    /**
     * 验证是否登录
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function isLogin(): bool
    {
        $token = $this->getToken();

        if (!$token) {
            return false;
        }
        $uid = $this->checkToken($token);

        if (!empty($uid)) {
            $this->token = $token;
            $this->userInfo = UserModel::find($uid);
            return true;
        }

        return false;
    }

    /**
     * 退出登录
     *
     * @return void
     */
    public function logout()
    {
        cookie('uid', null);
        cookie('token', null);
        cookie('nickname', null);
    }

    /**
     *
     * 返回前端令牌
     * @param mixed $userInfo
     * @param bool $token
     * @return void
     */
    public function responseToken($userInfo, bool $token = false)
    {
        $this->token = $token ? $this->getToken() : $this->buildToken($userInfo['id']);
        cookie('uid', $userInfo['id'], $this->keepTime);
        cookie('token', $this->token, $this->keepTime);
        cookie('nickname', $userInfo['nickname'], $this->keepTime);
        Cache::set($this->token, $userInfo['id'], $this->keepTime);
        Event::trigger("user_login_success", $userInfo);
    }

    /**
     * 生成token
     * @access protected
     * @param $id
     * @return string
     */
    protected function buildToken($id): string
    {
        return md5(Random::alpha(16) . $id);
    }

    /**
     * 获取token
     * @return array|string|null
     */
    public function getToken($token = 'token')
    {
        return request()->header($token, input($token, cookie($token)));
    }

    /**
     * 校验token
     * @access protected
     * @param $token
     * @return mixed
     */
    public function checkToken($token)
    {
        $userId = Cache::get($token);
        return $userId ?? false;
    }

    /**
     * 获取最后产生的错误
     * @return string
     */
    public function getError(): string
    {
        return $this->_error;
    }

    /**
     * 设置错误
     * @param string $error 信息信息
     */
    protected function setError(string $error)
    {
        $this->_error = $error;
    }
}
