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

use app\common\model\system\AdminRules;
use Exception;
use FilesystemIterator;
use GuzzleHttp\Exception\TransferException;
use system\Http;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\facade\Cache;
use think\facade\Config;
use think\facade\Db;
use think\facade\Event;
use think\Route;
use Throwable;

class Service extends \think\Service
{
    /**
     * 当前插件路径
     * @var string
     */
    public $pluginPath = '';

    /**
     * 注册服务
     *
     * @return void
     */
    public function register()
    {
        include_once __DIR__ . '/Function.php';
        $this->pluginPath = root_path('plugin');
        define('PLUGIN_PATH', $this->pluginPath);
        define('PLUGIN_MENU', 'data/menu.php');

        if (!is_dir($this->pluginPath)) {
            @mkdir($this->pluginPath, 0755, true);
        }

        foreach (scandir($this->pluginPath) as $dir) {
            if ($dir == '.' || $dir == '..') {
                continue;
            }

            $dir = $this->pluginPath . $dir;
            $file = $dir . '/function.php';
            if (is_dir($dir) && is_file($file)) {
                include_once $file;
            }
        }

        $hooks = $this->app->isDebug() ? [] : Cache::get('plug-in.hooks', []);
        if (empty($hooks)) {
            $hooks = Config::get('plugin.hooks');
            foreach ($hooks as $key => $value) {
                $hooks[$key] = array_filter(array_map(function ($elem) use ($key) {
                    $class = get_plugin_class($elem);
                    return $class ? [$class, $key] : [];
                }, $value));
            }

            Cache::set('plug-in.hooks', $hooks);
        }

        Event::listenEvents($hooks);
        if (isset($hooks['appInit'])) {
            foreach ($hooks['appInit'] as $value) {
                Event::trigger('appInit', $value);
            }
        }

        $this->app->bind('plugin', Service::class);
    }

    /**
     * 执行服务
     *
     * @return void
     */
    public function boot()
    {
        // 注册路由
        $this->registerRoutes(function (Route $route) {
            $routes = Config::get('plugin.router', []);
            foreach ($routes as $key => $value) {

                if (is_numeric($key)) {
                    continue;
                }

                if (!empty($value) && $key && substr($key, 0, 1) == '/') {
                    $route->rule($key, $value)->name($key)->completeMatch(true);
                }
            }
        });
    }

    /**
     * 插件下载
     * @param string $name
     * @param array $params
     * @return string
     * @throws Exception
     */
    public static function download(string $name, array $params): string
    {
        try {

            $apiUrl = self::getPluginUrl();
            $response = Http::get($apiUrl, $params);
            $ret = json_decode($response, true);
            $signUrl = $ret['data']['url'] ?: '';

            if (!empty($signUrl) && stristr($signUrl, 'download')) {
                $content = Http::get($signUrl);
                $filePath = PLUGIN_PATH . $name . '.zip';
                write_file($filePath, $content);
                return $filePath;
            } else {
                throw new Exception($ret['msg'], $ret['code'], $ret['data']);
            }

        } catch (TransferException $e) {
            throw new Exception(__("安装包下载失败"), -111);
        }
    }

    /**
     * 解压当前文件
     * @param string $filename
     * @param string $fileInfo
     * @param bool $config
     * @return mixed
     * @throws Exception
     */
    public static function unzip(string $filename, string $fileInfo = PLUGIN_PATH, bool $config = false)
    {
        if (preg_match('/^[a-z]{3,32}/', $filename)) {
            $filename = PLUGIN_PATH . $filename . '.zip';
        }

        if (!is_file($filename)) {
            throw new Exception(__('插件文件不存在'), -113);
        }

        $archive = new \ZipArchive();
        if ($archive->open($filename) !== TRUE) {
            throw new Exception(__("访问安装包失败"), -114);
        }

        try {

            if ($config) {

                for ($i = 0; $i < $archive->numFiles; $i++) {
                    if (preg_match('/^(\w+)\/config.php$/i', $archive->getNameIndex($i))) {
                        $fileInfo = @eval(str_replace('<?php', '', $archive->getFromIndex($i)));
                    }
                }

                if (!isset($fileInfo['name'])) {
                    throw new Exception(__("插件配置文件不存在"), -115);
                }

            } else {
                $archive->extractTo($fileInfo);
            }
        } catch (Throwable $th) {
            throw new Exception(__("解压 %s 安装包失败", $filename), -115);
        } finally {
            $archive->close();
        }

        return $fileInfo;
    }

    /**
     * 获取插件地址
     * @param string $name
     * @param bool $onlyFiles
     * @return array
     */
    public static function fileConflict(string $name, bool $onlyFiles = false): array
    {
        $list = [];
        $copyDirs = self::getCopyDirs();
        $pluginPath = self::getPluginPath($name);
        foreach ($copyDirs as $key => $dir) {
            $filesPath = $pluginPath . $dir;
            if (is_dir($filesPath)) {
                $files = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($filesPath, FilesystemIterator::SKIP_DOTS),
                    \RecursiveIteratorIterator::CHILD_FIRST
                );

                foreach ($files as $index => $file) {
                    if ($file->isFile()) {
                        $filePath = $file->getPathname();
                        $appPath = str_replace($pluginPath, '', $filePath);
                        $destPath = root_path() . $appPath;
                        if ($onlyFiles) {
                            if (is_file($destPath)) {
                                if (md5_file($filePath) != md5_file($destPath)) {
                                    $list[] = $appPath;
                                }
                            }
                        } else {
                            $list[] = $appPath;
                        }
                    }
                }
            }
        }

        return $list;
    }

    /**
     * 导入目录下Install.sql文件
     * @param string $name
     * @return void
     * @throws Exception
     */
    public static function importSql(string $name)
    {
        $sqlPath = PLUGIN_PATH . $name . '/install.sql';
        if (is_file($sqlPath)) {
            $sql = file_get_contents($sqlPath);
            $sqlRecords = str_ireplace("\r", "\n", $sql);
            $sqlRecords = explode(";\n", $sqlRecords);
            $sqlRecords = str_replace("__PREFIX__", env('database.prefix'), $sqlRecords);
            foreach ($sqlRecords as $line) {
                if (empty($line)) {
                    continue;
                }
                try {
                    Db::getPdo()->exec($line);
                } catch (Throwable $th) {
                }
            }
        }
    }

    /**
     * 安装远程插件
     * @param string $name
     * @param array $params
     * @param bool $cover
     * @param string $localFile
     * @return array
     * @throws DataNotFoundException
     * @throws Exception
     */
    public static function install(string $name, array $params = [], bool $cover = false, string $localFile = ''): array
    {
        if (self::checkStatus($name) && !$cover) {
            throw new Exception(__("请勿重复安装 %s 插件", $name), -116);
        }

        $pluginPath = self::getPluginPath($name);
        $filePath = $localFile ?: self::download($name, $params);

        try {

            self::unzip($filePath);

            if (!$cover) {
                $list = self::fileConflict($name, true);
                if (!empty($list)) {
                    throw new Exception(__("存在文件冲突：%s", implode(',', $list)), -117);
                }
            }

            $menuFile = $pluginPath . PLUGIN_MENU;
            if (is_file($menuFile)) {
                $data = include($menuFile);
                Service::createMenu($data, $name);
            }

            $pluginClass = get_plugin_class($name);
            $pluginObject = new $pluginClass();
            if (method_exists($pluginObject, 'install')) {
                $pluginObject->install();
            }

            self::importSql($name);
            self::enabled($name);
        } catch (Exception $e) {
            recursive_delete($pluginPath);
            throw new Exception($e->getMessage());
        } finally {
            @unlink($filePath);
        }

        return get_plugin_config($name, true);
    }

    /**
     * 卸载插件
     *
     * @param string $name
     * @param bool $force 是否强制卸载
     * @return bool
     * @throws Exception
     */
    public static function uninstall(string $name, bool $force = false): bool
    {
        if (!$name || !is_dir(PLUGIN_PATH . $name)) {
            throw new Exception(__("插件数据不存在"), -117);
        }

        $pluginDir = self::getPluginPath($name);
        $list = self::fileConflict($name) ?? [];
        if (!$force) {
            $list = self::fileConflict($name, true);
            if (!empty($list)) {
                throw new Exception(__("存在文件冲突：%s", implode(',', $list)), -117);
            }
        }

        foreach ($list as $item) {
            @unlink(root_path() . $item);
        }

        try {

            $class = get_plugin_class($name);
            if (class_exists($class)) {
                $plugin = new $class();
                $plugin->uninstall();
            }

            recursive_delete($pluginDir);
            plugin_refresh_hooks();
            Service::deleteMenu($name);
        } catch (Throwable $th) {
            throw new Exception($th->getMessage());
        }

        return true;
    }

    /**
     * 升级插件
     *
     * @param string $name 插件名称
     * @param array $params 扩展参数
     * @param string $localFile
     * @return array
     * @throws DataNotFoundException
     * @throws Exception
     */
    public static function upgrade(string $name, array $params = [], string $localFile = ''): array
    {
        $config = get_plugin_config($name, true);

        if ($config['status']) {
            throw new Exception(__('请先禁用插件再升级'));
        }

        $pluginPath = self::getPluginPath($name);
        $filePath = $localFile ?: self::download($name, $params);

        try {

            // 获取配置项
            $pluginInfo = self::unzip($filePath, '', true);
            if (version_compare($config['version'], $pluginInfo['version'], ">=")) {
                throw new \Exception('插件版本不能低于当前版本');
            }

            Service::backup($name);
            self::unzip($filePath);

            $menuFile = $pluginPath . PLUGIN_MENU;
            if (is_file($menuFile)) {
                $data = include($menuFile);
                Service::createMenu($data, $name);
            }

            $class = get_plugin_class($name);
            $upgrade = str_replace(ucfirst($name), 'Upgrade', $class);
            if (class_exists($upgrade)) {
                $object = new $upgrade();
                if (method_exists($object, 'execute')) {
                    $object->execute();
                }
            }

            $UpgradeInfo = array_merge($pluginInfo, [
                'extends' => $config['extends'],
                'rewrite' => $config['rewrite'],
            ]);

            arr2file($pluginPath . 'config.php', $UpgradeInfo);
            Service::importsql($name);
            Service::enabled($name);

        } catch (Throwable $th) {
            throw new Exception($th->getMessage(), $th->getCode());
        } finally {
            @unlink($filePath);
        }

        return get_plugin_config($name, true);
    }


    /**
     * 启用插件
     * @param string $name
     * @return bool
     * @throws Exception
     */
    public static function enabled(string $name): bool
    {
        if (!$name || !is_dir(PLUGIN_PATH . $name)) {
            throw new Exception(__('插件数据不存在'), -117);
        }

        $pluginDir = self::getPluginPath($name);
        $copyDirs = self::getCopyDirs();

        foreach ($copyDirs as $copyDir) {
            if (is_dir($pluginDir . $copyDir)) {
                copydirs($pluginDir . $copyDir, root_path() . $copyDir);
            }
        }

        try {

            $class = get_plugin_class($name);
            if (class_exists($class)) {
                $plugin = new $class();
                if (method_exists($class, "enabled")) {
                    $plugin->enabled();
                }
            }

            Service::enabledMenu($name);
            set_plugin_config($name, ['status' => 1]);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return true;
    }

    /**
     * 禁用插件
     * @param string $name
     * @return bool
     * @throws Exception
     */
    public static function disabled(string $name): bool
    {
        if (!$name || !is_dir(PLUGIN_PATH . $name)) {
            throw new Exception(__('插件数据不存在'), -117);
        }

        $pluginDir = self::getPluginPath($name);
        foreach (self::getCopyDirs() as $dir) {
            if (is_dir($pluginDir . $dir)) {
                $files = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($pluginDir . $dir, FilesystemIterator::SKIP_DOTS),
                    \RecursiveIteratorIterator::CHILD_FIRST
                );

                foreach ($files as $fileinfo) {
                    $dirFile = str_replace($pluginDir, root_path(), $fileinfo->getPathname());
                    if ($fileinfo->isFile()) {
                        @unlink($dirFile);
                    } else if ($fileinfo->isDir()) {
                        remove_empty_dir($dirFile);
                    }
                }
            }
        }

        try {

            $class = get_plugin_class($name);
            if (class_exists($class)) {
                $plugin = new $class();
                if (method_exists($class, "disabled")) {
                    $plugin->disabled();
                }
            }

            Service::disabledMenu($name);
            set_plugin_config($name, ['status' => 0]);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return true;
    }

    /**
     * 备份插件
     * @param string $name 插件名称
     * @return bool
     * @throws Exception
     */
    public static function backup(string $name): bool
    {
        $backup = Service::getBackupDir();
        $file = $backup . $name . '-backup-' . date("YmdHis") . '.zip';

        $zip = new \ZipArchive();
        try {

            $zip->open($file, \ZipArchive::CREATE);
            $pluginDir = self::getPluginPath($name);
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($pluginDir, FilesystemIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::CHILD_FIRST
            );

            foreach ($files as $fileinfo) {
                // 如果是文件
                if ($fileinfo->isFile()) {
                    $filePath = $fileinfo->getPathName();
                    $zip->addFile($filePath, str_replace(PLUGIN_PATH, '', $filePath));
                } else {
                    $localDir = str_replace(PLUGIN_PATH, "", $fileinfo->getPathName());
                    $zip->addEmptyDir($localDir);
                }
            }

        } catch (Throwable $th) {
            throw new Exception($th->getMessage());
        } finally {
            $zip->close();
        }

        return true;
    }

    /**
     * 创建菜单
     * @param array $list 菜单列表
     * @param string $note
     * @param mixed $parent 父类的name或pid
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function createMenu(array $list = [], string $note = '', $parent = 0)
    {
        if (!is_numeric($parent)) {
            $parentRule = AdminRules::getByTitle($parent);
            $pid = $parentRule ? $parentRule['id'] : 0;
        } else {
            $pid = $parent;
        }

        $allow = array_flip(['title', 'router', 'alias', 'type', 'icon', 'note', 'status']);

        foreach ($list as $value) {

            // 子分类数据
            $data = array_intersect_key($value, $allow);
            $data['pid'] = $pid;
            $children = isset($value['children']) && $value['children'];

            if (!isset($value['type'])) {
                $data['type'] = $children ? 0 : 1;
            } else {
                $data['type'] = $value['type'];
            }

            // PLUGIN 标识
            $data['note'] = $note;
            $data['auth'] = $value['auth'] ?? 1;
            $data['isSystem'] = $value['isSystem'] ?? 0;

            if (!isset($value['sort'])) {
                $data['sort'] = AdminRules::count() + 1;
            } else {
                $data['sort'] = $value['sort'];
            }

            $data['alias'] = substr(str_replace('/', ':', $data['router']), 1);

            // 查询当前菜单
            $menu = AdminRules::withTrashed()->where(['note' => $data['note'], 'pid' => $data['pid'], 'router' => $data['router']])->find();

            if (empty($menu)) {
                $menu = AdminRules::create($data);
            } else {
                $menu->where('id', $menu->id)->update($data);
            }

            if ($children) {
                self::createMenu($value['children'], $note, $menu['id']);
            }
        }
    }

    /**
     * 启用菜单
     * @param string $name
     * @return boolean
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function enabledMenu(string $name): bool
    {
        $ids = self::getAuthRuleIdsByNote($name);
        if (!empty($ids)) {
            $list = AdminRules::onlyTrashed()->where('id', 'in', $ids)->select();
            foreach ($list as $item) {
                if ($item->delete_time) {
                    $item->restore();
                }
            }
        }

        return true;
    }

    /**
     * 禁用菜单
     * @param string $name
     * @return boolean
     */
    public static function disabledMenu(string $name): bool
    {
        $ids = self::getAuthRuleIdsByNote($name);
        if (!empty($ids)) {
            AdminRules::destroy($ids);
        }

        return true;
    }

    /**
     * 导出指定名称的菜单规则
     * @param string $name
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function exportMenu(string $name): array
    {
        $menuList = AdminRules::field('id,pid,title,router,icon,auth,type')->where('note', $name)->select()->toArray();
        return self::delIdPid(list_to_tree($menuList));
    }

    /**
     * 删除菜单
     * @param string $name 规则name
     * @return boolean
     */
    public static function deleteMenu(string $name): bool
    {
        $ids = self::getAuthRuleIdsByNote($name, strpos($name, '/') !== false);
        if (!empty($ids)) {
            AdminRules::destroy($ids, true);
        }

        return true;
    }

    /**
     * 根据名称获取规则IDS
     * @param string $name
     * @param bool $like
     * @return array
     */
    public static function getAuthRuleIdsByNote(string $name, bool $like = false): array
    {
        $where[] = !$like ? ['note', '=', $name] : ['router', 'like', '%' . $name . '%'];
        return AdminRules::withTrashed()->where($where)->column('id');
    }

    /**
     * 递归删除
     * @param $menuList
     * @return array
     */
    protected static function delIdPid($menuList): array
    {
        foreach ($menuList as $key => $value) {
            unset($menuList[$key]['id']);
            unset($menuList[$key]['pid']);
            if (isset($value['children'])) {
                $menuList[$key]['children'] = self::delIdPid($value['children']);
            }
        }
        return $menuList;
    }

    /**
     * 获取服务器接口
     * @return mixed
     */
    public static function getServerUrl()
    {
        return \config('app.api_url');
    }

    /**
     * 查询插件信息
     * @return string
     */
    public static function getPluginUrl(): string
    {
        return self::getServerUrl() . 'plugin/query';
    }

    /**
     * 获取插件路径
     * @param string $name
     * @return string
     */
    public static function getPluginPath(string $name): string
    {
        return PLUGIN_PATH . $name . DIRECTORY_SEPARATOR;
    }

    /**
     * 获取插件备份目录
     * @return string
     */
    public static function getBackupDir(): string
    {
        $dir = root_path('runtime/plugin') . DIRECTORY_SEPARATOR;
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        return $dir;
    }


    /**
     * 返回 [app, public] 的路径
     * @return array
     */
    public static function getCopyDirs(): array
    {
        return ['app', 'public'];
    }

    /**
     * 检查插件是否存在
     * @param string $name
     * @return bool
     */
    public static function checkStatus(string $name): bool
    {
        $pluginPath = self::getPluginPath($name);
        if (!is_dir($pluginPath)) {
            return false;
        }

        return true;
    }
}
