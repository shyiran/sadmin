<?php
declare(strict_types=1);
// +----------------------------------------------------------------------
// | swiftAdmin 极速开发框架 [基于ThinkPHP6开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2019-2020 http://www.swiftadmin.net
// +----------------------------------------------------------------------
// | swiftAdmin.net High Speed Development Framework
// +----------------------------------------------------------------------
// | Author: meystack 鸣谢 https://github.com/zz-studio/think-addons
// | Apache 2.0 License Code
// +----------------------------------------------------------------------

use think\db\exception\DataNotFoundException;
use think\facade\Cache;
use think\helper\Str;
use think\facade\Event;
use think\facade\Config;

/**
 * 插件类库自动加载
 */
spl_autoload_register(function ($class) {

    $class = ltrim($class, '\\');
    $dir = app()->getRootPath();
    $namespace = 'plugin';
    if (strpos($class, $namespace) === 0) {
        $path = null;
        $class = substr($class, strlen($namespace));
        if (($pos = strripos($class, '\\')) !== false) {
            $path = str_replace('\\', '/', substr($class, 0, $pos)) . '/';
            $class = substr($class, $pos + 1);
        }
        $path .= str_replace('_', '/', $class) . '.php';
        $dir .= $namespace . $path;
        if (file_exists($dir)) {
            include_once $dir;
            return true;
        }
    }

    return false;
});

if (!function_exists('hook')) {
    /**
     * 处理插件钩子
     * @param string $event 钩子名称
     * @param $params
     * @param bool $once 是否只返回一个结果
     * @return string
     */
    function hook(string $event, $params = null, bool $once = false): string
    {
        $result = Event::trigger($event, $params, $once);
        return join('', $result);
    }
}

if (!function_exists('get_plugin_class')) {
    /**
     * 获取插件类的类名
     * @param string $name 插件名
     * @param string $class 当前类名
     * @return string
     */
    function get_plugin_class(string $name, string $class = ''): string
    {
        $name = trim($name);
        $class = Str::studly(!$class ? $name : $class);
        $namespace = "\\plugin\\" . $name . "\\" . $class;
        return class_exists($namespace) ? $namespace : '';
    }
}

if (!function_exists('get_plugin_list')) {
    /**
     * 获取插件列表
     * @param array $list
     * @param array $other
     * @return array
     */
    function get_plugin_list(array &$list = [], array $other = []): array
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(PLUGIN_PATH, FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            if ($item->isDir()) {
                $name = $item->getBasename();
                $path = $item->getPathname();
                $config = $path . '/config.php';
                if (!is_file($config) || !is_file($path . '/' . ucfirst($name) . '.php')) {
                    continue;
                }

                try {
                    $regx = ['<?php', 'return', ';', '\n', '\r'];
                    $file = file_get_contents($config);
                    $file = str_replace($regx, '', $file);
                    @eval("\$config = " . $file . '; ');
                } catch (\Throwable $th) {
                    if (!$config || !is_array($config)) {
                        $config = include $config;
                    }
                }

                $list[$name] = $config;
            }
        }

        if (!empty($other)) {
            $list = array_merge($list, $other);
        }

        return $list ?? [];
    }
}

if (!function_exists('copydirs')) {
    /**
     * 复制文件夹
     * @param string $source 源文件夹
     * @param string $dest 目标文件夹
     */
    function copydirs(string $source, string $dest)
    {

        if (!is_dir($dest)) {
            mkdir($dest, 0755, true);
        }

        $handle = opendir($source);
        while (($file = readdir($handle)) !== false) {
            if ($file != "." && $file != "..") {
                if (is_dir($source . "/" . $file)) {
                    copydirs($source . "/" . $file, $dest . "/" . $file);
                } else {
                    copy($source . "/" . $file, $dest . "/" . $file);
                }
            }
        }

        closedir($handle);
    }
}

if (!function_exists('remove_empty_dir')) {
    /**
     * 删除空目录
     * @param string $dir 目录
     */
    function remove_empty_dir(string $dir)
    {
        try {
            if (is_dir($dir)) {
                $handle = opendir($dir);
                while (($file = readdir($handle)) !== false) {
                    if ($file != "." && $file != "..") {
                        remove_empty_dir($dir . "/" . $file);
                    }
                }

                if (readdir($handle) == false) {
                    @rmdir($dir);
                }

                closedir($handle);
            }
        } catch (\Exception $e) {
        }
    }
}

if (!function_exists('recursive_delete')) {
    /**
     * 递归删除目录
     * @param string $dir 目录
     */
    function recursive_delete(string $dir)
    {
        try {
            if (is_dir($dir)) {
                $files = scandir($dir);
                foreach ($files as $file) {
                    if ($file != "." && $file != "..") {
                        recursive_delete($dir . "/" . $file);
                    }
                }
                @rmdir($dir);
            } else if (is_file($dir)) {
                @unlink($dir);
            }
        } catch (\Exception $e) {
        }
    }
}

if (!function_exists('get_plugin_config')) {
    /**
     * 获取插件配置
     * @param string $name 插件名
     * @param bool $force 是否缓存
     * @return array
     * @throws \Exception
     * @throws DataNotFoundException
     */
    function get_plugin_config(string $name, bool $force = false): array
    {

        $array = [];
        $tags = sha1('PLUGIN_' . $name);
        if (!$force || !env('APP_DEBUG')) {
            if ($array = Cache::get($tags)) {
                return $array;
            }
        }

        try {

            $pluginPath = PLUGIN_PATH . $name;
            $filePath = $pluginPath . '/config.php';

            if (is_file($filePath)) {
                $regx = ['<?php', 'return', ';', '\n', '\r'];
                $file = file_get_contents($filePath);
                $file = str_replace($regx, '', $file);

                @eval("\$array = " . $file . '; ');
                if (is_array($array)) {
                    $array['path'] = $pluginPath;
                    $array['config'] = is_file($pluginPath . '/config.html') ? 1 : 0;
                }
            }

        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), -999);
        }

        Cache::set($tags, $array, 86400);
        return $array ?? [];
    }
}

if (!function_exists('set_plugin_config')) {
    /**
     * 设置插件配置
     * @param string $name 插件名
     * @param array $value
     * @return array
     * @throws DataNotFoundException
     */
    function set_plugin_config(string $name, array $value): array
    {
        $config = get_plugin_config($name, true);
        $config = array_merge($config, $value);
        $filePath = root_path('plugin/' . $name) . 'config.php';
        arr2file($filePath, $config);
        Cache::set(sha1('PLUGIN' . $name), $config);
        try {
            plugin_refresh_hooks();
        } catch (Exception $e) {
        }
        return $config;
    }
}

if (!function_exists('plugin_refresh_hooks')) {
    /**
     * 刷新插件配置
     * @param bool $truncate
     * @return boolean
     * @throws Exception
     */
    function plugin_refresh_hooks(bool $truncate = true): bool
    {
        $plugin = Config::get('plugin');

        if ($truncate) {
            $plugin['hooks'] = [];
            $plugin['router'] = [];
        }

        // 获取插件列表
        $listDirs = get_plugin_list();
        $priority = $plugin['priority'];
        if (!is_array($priority)) {
            $priority = explode(',', $priority);
        }

        $pluginList = [];
        $priorityHook = array_merge($priority, array_keys($listDirs));

        foreach ($priorityHook as $key) {

            if (!isset($listDirs[$key])) {
                continue;
            }

            $pluginList[$key] = $listDirs[$key];
        }

        // 循环处理钩子
        foreach ($pluginList as $name => $value) {

            if (!$value['status']) {
                continue;
            }

            $methods = get_class_methods("\\plugin\\" . $name . "\\" . ucfirst($name));
            $diff_hooks = array_diff($methods, get_class_methods("\\app\\common\\plugin\\Controller"));
            foreach ($diff_hooks as $hook) {

                if (!isset($plugin['hooks'][$hook])) {
                    $plugin['hooks'][$hook] = [];
                }

                // 兼容手动配置项
                if (is_string($plugin['hooks'][$hook])) {
                    $plugin['hooks'][$hook] = explode(',', $plugin['hooks'][$hook]);
                }

                if (!in_array($name, $plugin['hooks'][$hook])) {
                    $plugin['hooks'][$hook][] = $name;
                }
            }

            // 路由配置
            $rules = [];
            array_walk($value['rewrite'], function ($v, $k) use ($name, &$rules) {
                if (!is_numeric($k) && $k && substr($k, 0, 1) == '/') {
                    $rules[$k] = $name . '/' . $v;
                }
            });

            $plugin['router'] = array_merge($plugin['router'] , $rules);
        }


        try {
            // 写入插件配置
            arr2file(config_path() . 'plugin.php', $plugin);
        } catch (\Throwable $th) {
            throw new Exception("写入配置文件出错 " . $th->getMessage());
        }

        return true;
    }
}

if (!function_exists('get_plugin_tables')) {
    /**
     * 获取插件install.sql文件路径
     * @param string $name 插件名
     * @return array
     */
    function get_plugin_tables(string $name): array
    {
        $pluginPath = PLUGIN_PATH . $name;
        $sqlFile = $pluginPath . '/install.sql';
        $regex = "/^CREATE\s+TABLE\s+(IF\s+NOT\s+EXISTS\s+)?`?([a-zA-Z_]+)`?/mi";
        $tables = [];
        if (is_file($sqlFile)) {
            preg_match_all($regex, file_get_contents($sqlFile), $matches);
            if (isset($matches[2])) {
                foreach ($matches[2] as $index => $match) {
                    $tables[] = str_replace('__PREFIX__', env('database.prefix'), $match);
                }
            }
        }

        return $tables;
    }
}