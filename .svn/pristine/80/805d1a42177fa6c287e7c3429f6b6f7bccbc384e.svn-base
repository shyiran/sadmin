<?php

declare(strict_types=1);
// +----------------------------------------------------------------------
// | swiftAdmin 极速开发框架 [基于ThinkPHP6开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2020-2030 http://www.swiftadmin.net
// +----------------------------------------------------------------------
// | swiftAdmin.net High Speed Development Framework
// +----------------------------------------------------------------------
// | Author: meystack 鸣谢 https://github.com/zz-studio/think-addons
// | Apache 2.0 License Code
// +----------------------------------------------------------------------

namespace app\common\plugin;

/**
 * 插件核心基类
 * Class Plugin
 */
abstract class Controller
{
    /**
     * 视图实例对象
     * @var \think\View|null
     */
    protected $view = null;

    /**
     * 插件目录
     * @var
     */
    public $pluginPath = null;

    /**
     * 插件标识
     * @var
     */
    protected $pluginName = '';

    /**
     * 架构函数
     * @access public
     */
    public function __construct()
    {
        $this->pluginName = $this->getPluginName();
        $this->pluginPath = PLUGIN_PATH . $this->pluginName . DIRECTORY_SEPARATOR;
        if (method_exists($this, 'initialize')) {
            $this->initialize();
        }
    }

    // 初始化
    protected function initialize()
    {}

        /**
     * 获取当前插件名
     * @return string
     */
    final public function getPluginName(): string
    {
        $data = explode('\\', get_class($this));
        return strtolower(array_pop($data));
    }

    /**
     * 必须实现以下方法
     * @return mixed
     */
    abstract public function install();
    abstract public function uninstall();
    abstract public function enabled();
    abstract public function disabled();
}