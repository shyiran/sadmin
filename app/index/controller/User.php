<?php
declare(strict_types=1);
namespace app\index\controller;
use app\HomeController;
use system\Random;
use app\common\library\Sms;
use app\common\library\Email;
use app\common\library\Upload;
use app\common\model\system\User as UserModel;
use think\response\View;

class User extends HomeController
{
    /**
     * 鉴权控制器
     */
    public $needLogin = true;

    /**
     * 非登录鉴权方法
     */
    public $noNeedAuth = ['login', 'register', 'forgot', 'check'];

    // 初始化函数
    public function initialize()
    {
        parent::initialize();
        $this->model = new UserModel();
    }

    /**
     * 用户中心
     */
    public function index(): View
    {
        return view();
    }

    /**
     * 用户注册
     */
    public function register()
    {
        if (request()->isPost()) {

            // 获取参数
            $post = safe_input('post.');
            $post = post_validate_rules($post, get_class($this->model));

            if (!is_array($post)) {
                return $this->error($post);
            }

            /**
             * 是否开启手机注册
             */
            if (saenv('user_register_style') == 'mobile') {
                $mobile = input('mobile');
                $captcha = input('captcha');
                if (!Sms::instance()->check($mobile, $captcha, 'register')) {
                    return $this->error(Sms::instance()->getError());
                }
            }

            if (!$this->auth->register($post)) {
                return $this->error($this->auth->getError());
            }

            return $this->success('注册成功', (string)url("/user/index"));
        }

        return view('', [
            'style' => saenv('user_register_style'),
        ]);
    }

    /**
     * 用户登录
     * @return View
     */
    public function login(): View
    {
        if (request()->isPost()) {
            $nickname = input('nickname/s');
            $password = input('pwd/s');

            if (!$this->auth->login($nickname, $password)) {
                return $this->error($this->auth->getError());
            }

            return $this->success('登录成功', (string)url('/'));
        }

        return $this->view('', [
            'referer' => request()->server('HTTP_REFERER', '/'),
        ]);
    }

    /**
     * 找回密码
     * @return View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function forgot(): View
    {
        if (request()->isPost()) {

            $email = safe_input('email');
            $mobile = safe_input('mobile');
            $event = safe_input('event');
            $captcha = safe_input('captcha');
            $pwd = safe_input('pwd');

            if (!empty($email)) {
                if (!Email::instance()->check($email, $captcha, $event)) {
                    return $this->error(Email::instance()->getError());
                }
            } else {
                if (!Sms::instance()->check($mobile, $captcha, $event)) {
                    return $this->error(Sms::instance()->getError());
                }
            }

            $where = $email ? ['email' => $email] : ['mobile' => $mobile];
            $userInfo = $this->model->where($where)->find();
            if (!$userInfo) {
                return $this->error('用户不存在');
            }

            try {
                $salt = Random::alpha();
                $pwd = encryptPwd($pwd, $salt);
                $this->model->update(['id' => $userInfo['id'], 'pwd' => $pwd, 'salt' => $salt]);

            } catch (\Exception $e) {
                return $this->error('修改密码失败，请联系管理员');
            }

            return $this->success('修改密码成功！');
        }

        return $this->view();
    }

    /**
     * 用户资料
     */
    public function profile()
    {
        if (request()->isPost()) {

            $nickname = safe_input('nickname/s');
            $post = post_validate_rules(input(), get_class($this->model), 'nickname');
            if (!is_array($post)) {
                return $this->error($post);
            }

            if ($this->model->where('nickname', $nickname)->find()) {
                return $this->error('当前昵称已被占用，请更换！');
            }

            if ($this->model->update(['id' => $this->userId, 'nickname' => $nickname])) {
                return $this->success('修改昵称成功！', (string)url('/user/index'));
            }

            return $this->error();
        }
        return $this->view();
    }

    /**
     * 修改密码
     * @return View
     */
    public function changepwd(): View
    {

        if (request()->isPost()) {

            // 获取参数
            $pwd = input('pwd');
            $oldPwd = input('oldpwd');
            $yPwd = encryptPwd($oldPwd, $this->userInfo->salt);

            if ($yPwd != $this->userInfo->pwd) {
                return $this->error('原密码输入错误！');
            }

            $salt = Random::alpha();
            $pwd = encryptPwd($pwd, $salt);
            $result = $this->model->update(['id' => $this->userId, 'pwd' => $pwd, 'salt' => $salt]);
            if (!empty($result)) {
                return $this->success('修改密码成功！');
            }

            return $this->error();
        }


        return view();
    }

    /**
     * 申请appKey
     * @return mixed
     */
    public function appid()
    {
        if (request()->isPost()) {
            $data = array();
            $data['id'] = $this->userId;
            $data['app_id'] = 10000 + $this->userId;
            $data['app_secret'] = Random::alpha(22);
            if ($this->model->update($data)) {
                return $this->success();
            }
            return $this->error();
        }
    }

    /**
     * 修改邮箱
     * @return mixed|View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function email()
    {

        if (request()->isPost()) {

            $email = safe_input('email');
            $event = safe_input('event');
            $captcha = safe_input('captcha');

            if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $this->error("您输入的邮箱格式不正确！");
            }

            if (UserModel::getByEmail($email)) {
                return $this->error("您输入的邮箱已被占用！");
            }

            $Ems = Email::instance();
            if (!empty($email) && !empty($captcha)) {

                if ($Ems->check($email, $captcha, $event)) {
                    $this->model->update(['id' => $this->userId, 'email' => $email]);
                    return $this->success('修改邮箱成功！');
                }

                return $this->error($Ems->getError());
            }

            $last = $Ems->getLast($email);
            if ($last && (time() - strtotime($last['create_time'])) < 60) {
                return $this->error(__('发送频繁'));
            }

            if ($Ems->captcha($email, $event)->send()) {
                return $this->success("邮件发送成功，请查收！");
            } else {
                return $this->error($Ems->getError());
            }
        }

        return $this->view();
    }


    /**
     * 修改手机号
     * @return mixed|View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function mobile()
    {

        if (request()->isPost()) {

            $mobile = safe_input('mobile');
            $event = safe_input('event');
            $captcha = safe_input('captcha');

            if (!is_mobile($mobile)) {
                return $this->error('手机号码不正确');
            }

            if ($mobile && UserModel::getByMobile($mobile)) {
                return $this->error("您输入的手机号已被占用！");
            }

            $Sms = Sms::instance();
            if (!empty($mobile) && !empty($captcha)) {

                if ($Sms->check($mobile, $captcha, $event)) {
                    $this->model->update(['id' => $this->userId, 'mobile' => (int)$mobile]);
                    return $this->success('修改手机号成功！');
                }

                return $this->error($Sms->getError());
            } else {

                $last = $Sms->getLast($mobile);
                if ($last && (time() - strtotime($last['create_time'])) < 60) {
                    return $this->error(__('发送频繁'));
                }

                if ($Sms->changer($mobile, $event)) {
                    return $this->success("验证码发送成功");
                } else {
                    return $this->error($Sms->getError());
                }
            }
        }

        return $this->view();
    }

    /**
     * 设置密保
     * @return View
     */
    public function protection(): View
    {
        $validate = [
            '你家的宠物叫啥？',
            '你的幸运数字是？',
            '你不想上班的理由是？',
        ];

        if (request()->isPost()) {
            $question = safe_input('question/s');
            $answer = safe_input('answer/s');

            if (!$question || !$answer) {
                return $this->error('设置失败');
            }

            if (!in_array($question, $validate)) {
                $question = current($validate);
            }

            try {
                $this->userInfo->question = $question;
                $this->userInfo->answer = $answer;
                $this->userInfo->save();
            } catch (\Throwable $th) {
                return $this->error();
            }

            return $this->success();
        }

        return $this->view('', [
            'validate' => $validate
        ]);
    }

    /**
     * 安全配置中心
     * @return View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function security(): View
    {
        /**
         * 计算安全比例
         */
        $maxProgress = 5;
        $thisProgress = 1;
        if ($this->userInfo->email) {
            $thisProgress++;
        }
        if ($this->userInfo->mobile) {
            $thisProgress++;
        }

        if ($this->userInfo->answer) {
            $thisProgress++;
        }

        if ($this->userInfo->wechat) {
            $thisProgress++;
        }

        // 计算比例
        $progress = (($thisProgress / $maxProgress) * 100);
        return $this->view('', [
            'progress' => $progress,
        ]);
    }

    /**
     * 用户头像上传
     * @return mixed|\think\response\Json|void
     * @throws \Exception
     */
    public function avatar()
    {

        if (request()->isPost()) {
            $filename = Upload::instance()->upload();
            if (!$filename) {
                return $this->error(Upload::instance()->getError());
            }
            $this->userInfo->avatar = $filename['url'] . '?' . Random::alpha(12);
            if ($this->userInfo->save()) {
                return json($filename);
            }
        }
    }

    /**
     * 文件上传函数
     * @return mixed
     * @throws \Exception
     */
    public function upload()
    {
        $invokeUpload = invoke('\app\api\controller\User');
        return $invokeUpload->upload();
    }
}
