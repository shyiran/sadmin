<?php

// 全局应用公共文件
use app\common\model\system\Config;
use think\facade\Cache;

// 权限常量
const AUTH_CATE = 'cates';
const AUTH_RULES = 'rules';

// +----------------------------------------------------------------------
// | 文件操作函数开始
// +----------------------------------------------------------------------
if (!function_exists('read_file')) {
    /**
     * 获取文件内容
     * @param string $file 文件路径
     * @return false|string content
     */
    function read_file(string $file)
    {
        return !is_file($file) ? '' : @file_get_contents($file);
    }
}


if (!function_exists('write_file')) {
    /**
     * 数据写入文件
     * @param $file
     * @param $content
     * @return false|int
     */
    function write_file($file, $content)
    {
        $dir = dirname($file);
        if (!is_dir($dir)) {
            mk_dirs($dir);
        }
        return @file_put_contents($file, $content);
    }
}

if (!function_exists('copy_file')) {
    /**
     * 复制文件
     * @param string $src
     * @param string $dst
     * @return bool
     */
    function copy_file(string $src, string $dst): bool
    {
        $dir = dirname($dst);
        if (!is_dir($dir)) {
            mk_dirs($dir);
        }

        return @copy($src, $dst);
    }
}

if (!function_exists('mk_dirs')) {
    /**
     * 递归创建文件夹
     * @param $path
     * @param int $mode 文件夹权限
     * @return bool
     */
    function mk_dirs($path, int $mode = 0777): bool
    {
        if (!is_dir(dirname($path))) {
            mk_dirs(dirname($path));
        }

        if (!file_exists($path)) {
            return mkdir($path, $mode);
        }

        return true;
    }
}

if (!function_exists('arr2file')) {
    /**
     * 数组写入文件
     * @param string $file 文件路径
     * @param array $array 数组数据
     * @return false|int
     */
    function arr2file(string $file, $array = '')
    {
        if (is_array($array)) {
            $cont = var_exports($array);
        } else {
            $cont = $array;
        }
        $cont = "<?php\nreturn $cont;";
        return write_file($file, $cont);
    }
}

if (!function_exists('arr2router')) {
    /**
     * 数组写入路由文件
     * @param string $file 文件路径
     * @param array $array
     * @return false|int
     */
    function arr2router(string $file, array $array = [])
    {
        if (is_array($array)) {
            $cont = var_exports($array);
        } else {
            $cont = $array;
        }
        $cont = "<?php\nuse think\\facade\\Route;\n\n$cont";
        return write_file($file, $cont);
    }
}

if (!function_exists('var_exports')) {
    /**
     * 数组语法(方括号)
     * @param array $expression 数组
     * @param bool $return 返回类型
     * @return mixed
     */
    function var_exports(array $expression, bool $return = true)
    {
        $export = var_export($expression, true);
        $patterns = [
            "/array \(/"                       => '[',
            "/^([ ]*)\)(,?)$/m"                => '$1]$2',
            "/=>[ ]?\n[ ]+\[/"                 => '=> [',
            "/([ ]*)(\'[^\']+\') => ([\[\'])/" => '$1$2 => $3',
        ];

        $export = preg_replace(array_keys($patterns), array_values($patterns), $export);
        if ($return) {
            return $export;
        } else {
            echo $export;
        }
    }
}


if (!function_exists('recursive_delete')) {
    /**
     * 递归删除目录
     */
    function recursive_delete($dir)
    {
        // 打开指定目录
        if ($handle = @opendir($dir)) {

            while (($file = readdir($handle)) !== false) {
                if (($file == ".") || ($file == "..")) {
                    continue;
                }
                if (is_dir($dir . '/' . $file)) { // 递归
                    recursive_delete($dir . '/' . $file);
                } else {
                    unlink($dir . '/' . $file); // 删除文件
                }
            }

            @closedir($handle);
            @rmdir($dir);
        }
    }
}

if (!function_exists('traverse_scanDir')) {
    /**
     * 递归遍历文件夹
     * @param bool $bool 是否递归
     * @param string $dir 文件夹路径
     * @return array
     */
    function traverse_scanDir(string $dir, bool $bool = true): array
    {
        $array = [];
        $handle = opendir($dir);
        while (($file = readdir($handle)) !== false) {
            # code...
            if ($file != '.' && $file != '..') {
                $child = $dir . '/' . $file;
                if (is_dir($child) && $bool) {
                    $array[$file] = traverse_scanDir($child);
                } else {
                    $array[] = $file;
                }
            }
        }

        return $array;
    }
}

// +----------------------------------------------------------------------
// | 字符串函数开始
// +----------------------------------------------------------------------
//

if (!function_exists('release')) {

    /**
     * 获取静态版本
     * @return int|mixed
     */
    function release()
    {
        return env('app_debug') ? rand(1000, 999999) : config('app.version');
    }
}

if (!function_exists('delNr')) {
    /**
     * 去掉换行
     * @param string $str 字符串
     * @return string
     */
    function delNr(string $str): string
    {
        $str = str_replace(array("<nr/>", "<rr/>"), array("\n", "\r"), $str);
        return trim($str);
    }
}

if (!function_exists('delNt')) {
    /**
     * 去掉连续空白
     * @param string $str 字符串
     * @return string
     */
    function delNt(string $str): string
    {
        $str = str_replace("　", ' ', str_replace("", ' ', $str));
        $str = preg_replace("/[\r\n\t ]{1,}/", ' ', $str);
        return trim($str);
    }
}

if (!function_exists('msubstr')) {
    /**
     * 字符串截取(同时去掉HTML与空白)
     * @param string $str
     * @param int $start
     * @param int $length
     * @param string $charset
     * @param bool $suffix
     * @return string
     */
    function msubstr(string $str, int $start = 0, int $length = 100, string $charset = "utf-8", bool $suffix = true): string
    {

        $str = preg_replace('/<[^>]+>/', '', preg_replace("/[\r\n\t ]{1,}/", ' ', delNt(strip_tags($str))));
        $str = preg_replace('/&(\w{4});/i', '', $str);

        // 直接返回
        if ($start == -1) {
            return $str;
        }

        if (function_exists("mb_substr")) {
            $slice = mb_substr($str, $start, $length, $charset);
        } elseif (function_exists('iconv_substr')) {
            $slice = iconv_substr($str, $start, $length, $charset);

        } else {
            $re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
            $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
            $re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
            $re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
            preg_match_all($re[$charset], $str, $match);
            $slice = join("", array_slice($match[0], $start, $length));
        }

        $fix = '';
        if (strlen($slice) < strlen($str)) {
            $fix = '...';
        }
        return $suffix ? $slice . $fix : $slice;
    }
}

if (!function_exists('cdn_Prefix')) {

    /**
     * 获取远程图片前缀
     * @return string
     */
    function cdn_Prefix()
    {
        return saenv('upload_http_prefix');
    }
}

if (!function_exists('pinyin')) {
    /**
     * 获取拼音
     * @param $chinese
     * @param bool $onlyFirst
     * @param string $delimiter
     * @param bool $ucFirst
     * @return string
     */
    function pinyin($chinese, bool $onlyFirst = false, string $delimiter = '', bool $ucFirst = false): string
    {
        $pinyin = new \Overtrue\Pinyin\Pinyin();

        if ($onlyFirst) {
            $result = $pinyin->abbr($chinese, $delimiter);
        } else {
            $result = $pinyin->permalink($chinese, $delimiter);
        }

        if ($ucFirst) {
            $pinyinArr = explode($delimiter, $result);
            $result = implode($delimiter, array_map('ucfirst', $pinyinArr));
        }

        return $result;
    }
}


if (!function_exists('format_bytes')) {

    /**
     * 将字节转换为可读文本
     * @param int $size 大小
     * @param string $delimiter 分隔符
     * @return string
     */
    function format_bytes(int $size, string $delimiter = ' '): string
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        for ($i = 0; $size >= 1024 && $i < 6; $i++) {
            $size /= 1024;
        }
        return round($size, 2) . $delimiter . $units[$i];
    }
}

if (!function_exists('hide_str')) {
    /**
     * 将一个字符串部分字符用*替代隐藏
     * @param string $string 待转换的字符串
     * @param int $begin 起始位置，从0开始计数，当$type=4时，表示左侧保留长度
     * @param int $len 需要转换成*的字符个数，当$type=4时，表示右侧保留长度
     * @param int $type 转换类型：0，从左向右隐藏；1，从右向左隐藏；2，从指定字符位置分割前由右向左隐藏；3，从指定字符位置分割后由左向右隐藏；4，保留首末指定字符串中间用***代替
     * @param string $glue 分割符
     * @return string   处理后的字符串
     */
    function hide_str(string $string, int $begin = 3, int $len = 4, int $type = 0, string $glue = "@")
    {
        if (empty($string)) {
            return false;
        }

        $array = array();
        if ($type == 0 || $type == 1 || $type == 4) {
            $strlen = $length = mb_strlen($string);
            while ($strlen) {
                $array[] = mb_substr($string, 0, 1, "utf8");
                $string = mb_substr($string, 1, $strlen, "utf8");
                $strlen = mb_strlen($string);
            }
        }
        if ($type == 0) {
            for ($i = $begin; $i < ($begin + $len); $i++) {
                if (isset($array[$i])) {
                    $array[$i] = "*";
                }
            }
            $string = implode("", $array);
        } elseif ($type == 1) {
            $array = array_reverse($array);
            for ($i = $begin; $i < ($begin + $len); $i++) {
                if (isset($array[$i])) {
                    $array[$i] = "*";
                }
            }
            $string = implode("", array_reverse($array));
        } elseif ($type == 2) {
            $array = explode($glue, $string);
            if (isset($array[0])) {
                $array[0] = hide_str($array[0], $begin, $len, 1);
            }
            $string = implode($glue, $array);
        } elseif ($type == 3) {
            $array = explode($glue, $string);
            if (isset($array[1])) {
                $array[1] = hide_str($array[1], $begin, $len, 0);
            }
            $string = implode($glue, $array);
        } elseif ($type == 4) {
            $left = $begin;
            $right = $len;
            $tem = array();
            for ($i = 0; $i < ($length - $right); $i++) {
                if (isset($array[$i])) {
                    $tem[] = $i >= $left ? "" : $array[$i];
                }
            }
            $tem[] = '*****';
            $array = array_chunk(array_reverse($array), $right);
            $array = array_reverse($array[0]);
            for ($i = 0; $i < $right; $i++) {
                if (isset($array[$i])) {
                    $tem[] = $array[$i];
                }
            }
            $string = implode("", $tem);
        }
        return $string;
    }
}

// +----------------------------------------------------------------------
// | 系统APP函数开始
// +----------------------------------------------------------------------
// 
if (!function_exists('__')) {
    /**
     * 全局多语言函数
     */
    function __($str, $vars = [], $lang = '')
    {
        if (is_numeric($str) || empty($str)) {
            return $str;
        }

        if (!is_array($vars)) {
            $vars = func_get_args();
            array_shift($vars);
            $lang = '';
        }

        return lang($str, $vars, $lang);
    }
}

if (!function_exists('saenv')) {
    /**
     * 获取系统配置信息
     * @param string $name
     * @param bool $group
     * @return mixed
     */
    function saenv(string $name, bool $group = false)
    {
        if (!empty($name)) {
            try {

                $redis = 'redis-sys_' . $name;
                $config = Cache::get($redis);
                if (empty($config) || env('app_debug')) {
                    $config = Config::all($name, $group);
                    Cache::set($redis, $config, config('cookie.expire'));
                }

                // 优先返回组配置
                if (!empty($group)) {
                    return $config;
                } else {
                    if (isset($config[$name]) && $config[$name]) {
                        return $config[$name];
                    }
                }
            } catch (\Throwable $th) {
            }
        }

        return false;
    }
}

if (!function_exists('system_cache')) {
    /**
     * 全局缓存控制函数
     * @param string|null $name
     * @param string ...cache
     * @param null $options
     * @param null $tag
     * @return mixed
     */
    function system_cache(string $name = null, $value = '', $options = null, $tag = null)
    {
        // 调试模式关闭缓存
        if (env('app_debug') || !saenv('cache_status')) {
            return false;
        }

        if (is_null($name)) {
            return app('cache');
        }

        if ('' === $value) {
            // 获取缓存
            return 0 === strpos($name, '?') ? Cache::has(substr($name, 1)) : Cache::get($name);
        } elseif (is_null($value)) {
            // 删除缓存
            return Cache::delete($name);
        }

        // 缓存数据
        if (is_array($options)) {
            $expire = $options['expire'] ?? null;
        } else {
            $expire = $options;
        }

        if (is_null($tag)) {
            return Cache::set($name, $value, $expire);
        } else {
            return Cache::tag($tag)->set($name, $value, $expire);
        }
    }
}

if (!function_exists('parse_array_ini')) {
    /**
     * 解析数组到ini文件
     * @param array $array 数组
     * @param string $content 字符串
     * @return string    返回一个ini格式的字符串
     */
    function parse_array_ini(array $array, string $content = ''): string
    {

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                // 分割符PHP_EOL
                $content .= PHP_EOL . '[' . $key . ']' . PHP_EOL;
                foreach ($value as $field => $data) {
                    $content .= $field . ' = ' . $data . PHP_EOL;
                }

            } else {
                $content .= $key . ' = ' . $value . PHP_EOL;
            }
        }

        return $content;
    }
}

if (!function_exists('list_search')) {
    /**
     * 从数组查找数据返回
     * @param array $list 原始数据
     * @param array $condition 规则['id'=>'??']
     * @return mixed
     */
    function list_search(array $list, array $condition)
    {
        if (is_string($condition)) {
            parse_str($condition, $condition);
        }
        // 返回的结果集合
        $resultSet = array();
        foreach ($list as $key => $data) {
            $find = false;
            foreach ($condition as $field => $value) {
                if (isset($data[$field])) {
                    if (0 === strpos($value, '/')) {
                        $find = preg_match($value, $data[$field]);
                    } else if ($data[$field] == $value) {
                        $find = true;
                    }
                }
            }
            if ($find)
                $resultSet[] = &$list[$key];
        }

        if (!empty($resultSet[0])) {
            return $resultSet[0];
        } else {
            return false;
        }
    }
}

if (!function_exists('list_to_tree')) {
    /**
     * 根据ID和PID返回一个树形结构
     * @param array $list 数组结构
     * @param string $id
     * @param string $pid
     * @param string $child
     * @param int $level
     * @return mixed
     */
    function list_to_tree(array $list, string $id = 'id', string $pid = 'pid', string $child = 'children', int $level = 0): array
    {
        // 创建Tree
        $tree = $refer = array();
        if (is_array($list)) {

            // 创建基于主键的数组引用
            foreach ($list as $key => $data) {
                $refer[$data[$id]] = &$list[$key];
            }

            foreach ($list as $key => $data) {

                // 判断是否存在parent
                $parentId = $data[$pid];
                if ($level == $parentId) {
                    $tree[] = &$list[$key];
                } else {
                    if (isset($refer[$parentId])) {
                        $parent = &$refer[$parentId];
                        $parent[$child][] = &$list[$key];
                    }
                }
            }
        }

        return $tree;
    }
}

if (!function_exists('list_sort_by')) {
    /**
     *----------------------------------------------------------
     * 对查询结果集进行排序
     *----------------------------------------------------------
     * @access public
     *----------------------------------------------------------
     * @param array $list 查询结果
     * @param string $field 排序的字段名
     * @param array $sortby 排序类型
     * @switch string  asc正向排序 desc逆向排序 nat自然排序
     *----------------------------------------------------------
     * @return mixed
     *----------------------------------------------------------
     */
    function list_sort_by(array $list, string $field, $sortby = 'asc')
    {
        if (is_array($list)) {
            $refer = $resultSet = array();
            foreach ($list as $i => $data)
                $refer[$i] = &$data[$field];
            switch ($sortby) {
                case 'asc': // 正向排序
                    asort($refer);
                    break;
                case 'desc':// 逆向排序
                    arsort($refer);
                    break;
                case 'nat': // 自然排序
                    natcasesort($refer);
                    break;
            }
            foreach ($refer as $key => $val)
                $resultSet[] = &$list[$key];
            return $resultSet;
        }
        return false;
    }
}

if (!function_exists('is_empty')) {
    /**
     * 判断是否为空值
     * @param array|string $value 要判断的值
     * @return bool
     */
    function is_empty($value): bool
    {
        if (!isset($value)) {
            return true;
        }

        if (trim($value) === '') {
            return true;
        }

        return false;
    }
}

if (!function_exists('is_mobile')) {

    /**
     * 验证输入的手机号码
     * @access  public
     * @param $mobile
     * @return bool
     */
    function is_mobile($mobile): bool
    {
        $chars = "/^((\(\d{2,3}\))|(\d{3}\-))?1(3|5|8|9)\d{9}$/";
        if (preg_match($chars, $mobile)) {
            return true;

        } else {
            return false;
        }
    }
}

if (!function_exists('check_referer_origin')) {
    /**
     * 检查跨域请求
     */
    function check_referer_origin()
    {
        $header = [
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => 1800,
            'Access-Control-Allow-Methods'     => 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers'     => 'Authorization, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-CSRF-TOKEN, X-Requested-With',
        ];

        $request = parse_url($_SERVER['HTTP_ORIGIN']);
        $domains = array_merge(config('app.cors_domain'), [request()->host(true)]);
        if (in_array("*", $domains) || in_array($_SERVER['HTTP_ORIGIN'], $domains)
            || (isset($request['host']) && in_array($request['host'], $domains))) {
            header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
            header(implode("\n", $header));
        } else {
            header('HTTP/1.1 403 Forbidden');
            exit;
        }
    }
}

// +----------------------------------------------------------------------
// | 数据加密函数开始
// +----------------------------------------------------------------------
if (!function_exists('encryptPwd')) {
    /**
     * hash - 密码加密
     */
    function encryptPwd($pwd, $salt = 'swift', $encrypt = 'md5')
    {
        return $encrypt($pwd . $salt);
    }
}

// +----------------------------------------------------------------------
// | 时间相关函数开始
// +----------------------------------------------------------------------
if (!function_exists('linux_extime')) {
    /**
     * 获取某天前时间戳
     * @param  $day
     * @return int
     */
    function linux_extime($day): int
    {
        $day = intval($day);
        return mktime(23, 59, 59, intval(date("m")), intval(date("d")) - $day, intval(date("y")));
    }
}

if (!function_exists('today_seconds')) {
    /**
     * 返回今天还剩多少秒
     * @return int
     */
    function today_seconds(): int
    {
        $mtime = mktime(23, 59, 59, intval(date("m")), intval(date("d")), intval(date("y")));
        return $mtime - time();
    }
}


if (!function_exists('is_today')) {
    /**
     * 判断当前是否为当天时间
     * @param $time
     * @return bool
     */
    function is_today($time): bool
    {

        if (!$time) {
            return false;
        }

        $today = date('Y-m-d');
        if (strstr($time, '-')) {
            $time = strtotime($time);
        }

        if ($today == date('Y-m-d', $time)) {
            return true;
        } else {
            return false;
        }
    }
}
// +----------------------------------------------------------------------
// | 系统安全函数开始
// +----------------------------------------------------------------------
if (!function_exists('post_validate_rules')) {
    /**
     * 单独验证模型 // 此函数不会过滤XSS
     * @param array $data POST数据
     * @param string $validateClass
     * @param string $validateScene
     * @return mixed
     */
    function post_validate_rules(array $data = [], string $validateClass = '', string $validateScene = '')
    {
        if (!is_empty($validateClass)) {
            if (!preg_match('/app\x{005c}(.*?)\x{005c}/', $validateClass, $match)) {
                $validateClass = '\\app\\common\\validate\\' . ucfirst($validateClass);

            } else {
                $validateClass = str_replace("\\model\\", "\\validate\\", $validateClass);
            }

            try {
                if (class_exists($validateClass)) {
                    $validate = new $validateClass;
                    if (!$validate->scene($validateScene)->check($data)) {
                        return $validate->getError();
                    }
                }
            } catch (Throwable $th) {
                return $th->getMessage();
            }
        }

        return $data;
    }
}

if (!function_exists('safe_input')) {

    /**
     * 过滤函数
     * @param string $key
     * @param $default
     * @param string $filter
     * @return mixed
     */
    function safe_input(string $key = '', $default = null, string $filter = 'trim,strip_tags,htmlspecialchars')
    {
        return input($key, $default, $filter);
    }
}
