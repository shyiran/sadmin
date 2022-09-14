<?php
declare (strict_types=1);

namespace app\admin\controller\system;

use app\common\plugin\Service;
use system\Http;
use think\facade\Db;
use app\AdminController;
use app\admin\library\Auth;
use Throwable;

/**
 * 插件市场
 * Class Plugin
 * @package app\admin\controller\system
 */
class Plugin extends AdminController
{
    /**
     * Http实例
     * @var Object
     */
    protected $http = null;

    /**
     * 查询最大数量
     * @var int
     */
    protected $limit = 1000;

    // 初始化函数
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 获取本地插件列表
     *
     * @return mixed|\think\response\View
     */
    public function index()
    {
        $pluginList = get_plugin_list();

        if (request()->isAjax()) {
            $onlinePlugin = $this->getPluginList($pluginList);
            return $this->success('获取成功', null, $onlinePlugin, count($onlinePlugin));
        }

        return view('', ['plugin' => json_encode($pluginList)]);
    }

    /**
     * 安装插件
     * @return mixed|void
     * @throws \Exception
     */
    public function install()
    {

        if (request()->isPost()) {

            $name = input('name/s');
            $token = input('token/s');

            if (!preg_match("/^[a-zA-Z0-9]+$/", $name)) {
                return $this->error('插件信息错误');
            }

            try {

                $params = [
                    'name'  => $name,
                    'token' => $token,
                ];

                $data = Service::install($name, $params) ?? [];
            } catch (Throwable $th) {
                return $this->error($th->getMessage(), null, null, $th->getCode());
            }

            return $this->success('插件安装成功', null, $data);
        }
    }

    /**
     * 插件升级
     * @return mixed|void
     */
    public function upgrade()
    {

        if (request()->isPost()) {

            $name = input('name/s');
            $token = input('token/s');
            $version = input('version');

            if (!preg_match("/^[a-zA-Z0-9]+$/", $name)) {
                return $this->error('插件信息错误');
            }

            try {

                // 扩展信息
                $extends = [
                    'name'    => $name,
                    'token'   => $token,
                    'version' => $version,
                ];

                $data = Service::upgrade($name, $extends) ?? [];
            } catch (Throwable $th) {
                return $this->error($th->getMessage(), null, null, $th->getCode());
            }

            return $this->success('插件更新成功', null, $data);
        }
    }

    /**
     * 卸载插件
     * @return mixed|void
     * @throws \think\db\exception\DataNotFoundException
     */
    public function uninstall()
    {

        if (request()->isAjax()) {

            $name = input('name/s');
            $tables = input('tables');
            $config = get_plugin_config($name, true);

            if (!$config || !preg_match("/^[a-zA-Z0-9]+$/", $name)) {
                return $this->error('当前插件不存在');
            }

            if ($config['status']) {
                return $this->error('请先禁用插件再卸载');
            }

            try {

                Service::uninstall($name, true);
                if ($tables && Auth::instance()->SuperAdmin()) {
                    foreach ($tables as $table) {
                        Db::execute("DROP TABLE IF EXISTS `$table`");
                    }
                }

            } catch (Throwable $th) {
                return $this->error($th->getMessage());
            }

            return $this->success('插件卸载成功');
        }
    }

    /**
     * 修改插件配置
     * @return mixed|\think\response\View
     * @throws \think\db\exception\DataNotFoundException
     */
    public function config()
    {
        $name = safe_input('name/s');
        $config = get_plugin_config($name, true);

        if (!$config || !preg_match("/^[a-zA-Z0-9]+$/", $name)) {
            return $this->error('插件不存在或已禁用');
        }

        if (request()->isPost()) {
            $post['extends'] = input('extends');
            $post['rewrite'] = input('rewrite');
            $config = array_merge($config, $post);
            try {
                set_plugin_config($name, $config);
            } catch (Throwable $th) {
                return $this->error($th->getMessage());
            }
            return $this->success();
        }

        return view($config['path'] . '/config.html', ['config' => $config]);
    }

    /**
     * 获取插件数据库表
     * @return mixed|void
     */
    public function tables()
    {
        if (request()->isAjax()) {
            $name = input('name/s');
            if (!$name || !preg_match("/^[a-zA-Z0-9]+$/", $name)) {
                $this->error('当前插件不存在');
            }

            $tables = get_plugin_tables($name);
            if ($tables = array_values($tables)) {
                $this->success('查询成功', null, ['tables' => $tables]);
            }
            return $this->error('当前插件无数据表');
        }
    }

    /**
     * 修改插件状态
     * 启用 / 禁用
     * @return mixed|void
     */
    public function status()
    {
        if (request()->isAjax()) {

            $name = input('id/s');
            $status = input('status/d');
            $plugin = get_plugin_class($name);

            if (!class_exists($plugin)) {
                return $this->error('插件不存在或已禁用');
            }

            try {
                $action = $status == 1 ? 'enabled' : 'disabled';
                Service::$action($name, false);
            } catch (Throwable $th) {
                return $this->error($th->getMessage());
            }
            return $this->success();
        }
    }

    /**
     * 获取服务器插件列表
     * @param array $pluginList
     * @return array
     */
    private function getPluginList(array $pluginList = []): array
    {
        try {

            $PluginApiList = Http::get(config('app.api_url') . '/plugin/index', ['limit' => $this->limit]);
            $PluginApiList = json_decode($PluginApiList, true)['data'];
            foreach ($pluginList as $name => $plugin) {
                $result = list_search($PluginApiList, ['name' => $plugin['name']]);
                if (!empty($result)) {
                    $pluginList[$name] = $result;
                }
            }

        } catch (Throwable $e) {}

        return $pluginList;
    }

}
