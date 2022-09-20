<?php
declare(strict_types=1);

namespace app\admin\controller;

use app\AdminController;
use app\common\library\Email;
use app\common\library\Ftp;
use app\common\model\system\Attachment;
use app\common\model\system\Config;
use app\common\model\system\User;
use app\common\model\system\UserGroup;
use app\common\model\system\UserThird;
use app\common\model\system\UserValidate;
use system\Random;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\facade\Cache;
use think\cache\driver\Redis;
use think\cache\driver\memcached;
use think\facade\Db;
use think\facade\Event;
use Throwable;

/**
 * 后台首页
 * Class Index
 * @package app\admin\controller
 */
class Index extends AdminController
{

    /**
     * 初始化
     * @return mixed|void
     */
    protected function initialize ()
    {
        parent::initialize ();
    }

    /**
     * 后台首页
     * @return mixed|\think\response\View
     */
    public function index ()
    {
        return view ();
    }

    /**
     * 控制台首页
     * @return \think\response\View
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function console (): \think\response\View
    {
        $dataList = [];
        $dateBefore = date ('Y-m-d', strtotime ('-30 day'));
        $dateAfter = date ('Y-m-d 23:59:59');

        if (request ()->isPost ()) {
            $cycle = safe_input ('cycle');
            if (Event::hasListener ('cms_user_echarts')) {
                [ $dataList, $seriesList ] = Event::trigger ('cms_user_echarts', $cycle, true);
                if (empty($seriesList)) {
                    return $this->error ('暂无数据');
                }

                $userChartsOptions = $this->getEchartsData (array_values ($dataList), $seriesList);
                return $this->success ('操作成功', '', $userChartsOptions);
            }

            return $this->error ('请安装CMS插件');
        }

        for ($i = -29; $i <= 0; $i++) {
            $dataList[date ('m-d', strtotime ($i . ' day'))] = date ('m-d', strtotime ($i . ' day'));
        }

        $seriesList = [];
        $condition = '%m-%d';
        $columns = [ '用户注册' => 'create_time', '用户登录' => 'login_time', '邀请注册' => 'invite_id' ];
        foreach ($columns as $index => $field) {
            $time = str_replace ('invite_id', 'create_time', $field);
            $resultList = User::where ($time, 'between time', [ $dateBefore, $dateAfter ])
                ->when ($condition, function ($query) use ($condition, $time, $field) {
                    $query->field ("FROM_UNIXTIME($time, '$condition') as day,count(*) as count");
                    if ($field == 'invite_id') {
                        $query->where ('invite_id', '<>', 0);
                    }
                    $query->group ($time);
                })->select ()->toArray ();
            $tempList = [];
            foreach ($dataList as $key => $item) {
                $data = list_search ($resultList, [ 'day' => $item ]);
                if (!empty($data)) {
                    $tempList[$key] = $data;
                } else {
                    $tempList[$key] = [ 'day' => $item, 'count' => 0 ];
                }
            }

            $seriesList[] = [
                'name' => $index,
                'type' => 'line',
                'stack' => 'Total',
                'showSymbol' => false,
                'itemStyle' => [ 'normal' => [ 'areaStyle' => [ 'type' => 'default' ] ] ],
                'data' => array_column ($tempList, 'count'),
            ];
        }

        $registerChartsOptions = $this->getEchartsData (array_keys ($dataList), $seriesList);

        $userGroupData = [];
        $userList = User::field ('group_id,count(id) as count')->group ('group_id')->select ()->toArray ();
        foreach ($userList as $item) {
            $title = UserGroup::where ('id', $item['group_id'])->value ('title');
            if (!empty($title)) {
                $userGroupData[] = [
                    'name' => $title,
                    'value' => $item['count']
                ];

            } else {
                $userGroupData[] = [
                    'name' => '未定义',
                    'value' => $item['count']
                ];
            }
        }
        $userGroupData[] = [ 'name' => '性别(男)', 'value' => User::where ('gender', 1)->count () ];
        $userGroupData[] = [ 'name' => '性别(女)', 'value' => User::where ('gender', 0)->count () ];
        // 搜索词云数据
        if (Event::hasListener ('cms_hot_search')) {
            $searchWords = Event::trigger ('cms_hot_search', null, true);
        } else {  // 模拟数据
            for ($i = 0; $i < 50; $i++) {
                $searchWords[] = [
                    'name' => Random::alpha (),
                    'value' => Random::number (),
                ];
            }
        }
        $pluginList = get_plugin_list ();
        $tableList = Db::query ('SHOW TABLE STATUS');
        $assetsInfo = [
            'pluginCount' => count ($pluginList),
            'pluginRunning' => array_sum (array_column ($pluginList, 'status')),
            'tableCount' => count ($tableList),
            'dbSize' => format_bytes (array_sum (array_map (function ($item) {
                return $item['Data_length'] + $item['Index_length'];
            }, $tableList))),
            'attachmentCount' => Attachment::count (),
            'attachmentSize' => format_bytes ((int)Attachment::sum ('filesize')),
        ];
        $theLogsCount = Db::name ('system_log')->count ('id');
        $exceptionCount = Db::name ('system_log')->where ('line', '>', 0)->count ('id');
        $devOpsData = [
            $theLogsCount,
            [
                'value' => $exceptionCount,
                'itemStyle' => [
                    'color' => '#a90000'
                ]
            ],
            $theLogsCount - $exceptionCount,
            UserValidate::whereNotNull ('email')->count ('id'),
            UserValidate::whereNotNull ('mobile')->count ('id'),
            User::count ('id'),
            UserThird::count ('id'),
        ];
        return view ('', [
            'assetsInfo' => $assetsInfo,
            'workplace' => Event::trigger ('cms_workplace', [], true) ?? [],
            'devOpsData' => json_encode ($devOpsData, JSON_UNESCAPED_UNICODE),
            'searchWords' => json_encode ($searchWords, JSON_UNESCAPED_UNICODE),
            'userGroupData' => json_encode ($userGroupData, JSON_UNESCAPED_UNICODE),
            'RegisterChartsOptions' => json_encode ($registerChartsOptions, JSON_UNESCAPED_UNICODE),
        ]);
    }

    /**
     * 获取数据结构
     * @param array $dataList
     * @param array $seriesList
     * @return array
     */
    protected function getEchartsData (array $dataList, array $seriesList): array
    {
        return [
            'color' => [ '#1890ff', '#ee6666', '#b0e689' ],
            'tooltip' => [ 'trigger' => 'axis' ],
            'legend' => [
                'orient' => 'horizontal',
            ],
            'grid' => [
                'left' => '5%',
                'top' => '13%',
                'bottom' => '15%',
                'right' => '5%'
            ],
            'xAxis' => [
                'type' => 'category',
                'boundaryGap' => true,
                'data' => $dataList,
            ],
            'yAxis' => [
                'type' => 'value',
            ],
            'series' => $seriesList
        ];
    }

    /**
     * 分析页
     */
    public function analysis (): \think\response\View
    {
        return view ();
    }

    /**
     * 监控页
     */
    public function monitor (): \think\response\View
    {
        return view ();
    }

    /**
     * 获取系统配置
     */
    public function basecfg (): \think\response\View
    {
        $config = Config::all ();
        $config['fsockopen'] = function_exists ('fsockopen');
        $config['stream_socket_client'] = function_exists ('stream_socket_client');
        return view ('', [ 'config' => $config ]);
    }

    /**
     * 编辑系统配置
     *
     * @param array $config
     * @return void
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function baseSet (array $config = [])
    {
        if (request ()->isPost ()) {
            $post = input ();
            $list = Config::select ()->toArray ();
            foreach ($list as $key => $value) {
                $name = $value['name'];
                // 字段必须存在
                if (isset($post[$name])) {
                    $option['id'] = $value['id'];
                    if ('array' == trim ($value['type'])) {
                        $option['value'] = json_encode ($post[$name], JSON_UNESCAPED_UNICODE);
                    } else {
                        $option['value'] = $post[$name];
                    }
                    $config[$key] = $option;
                }
            }
            try {
                (new Config())->saveAll ($config);
                $index = public_path () . 'index.php';
                $files = '../extend/conf/index.tpl';
                if ($post['site_status']) {
                    $close = '../extend/conf/close.tpl';
                    $content = file_get_contents ($close);
                    write_file ($index, $content);
                } else {
                    $content = file_get_contents ($index);
                    if (!strpos ($content, 'run()')) {
                        $content = file_get_contents ($files);
                        write_file ($index, $content);
                    }
                }
                // 配置文件路径
                $env = root_path () . '.env';
                $parse = parse_ini_file ($env, true);
                $parse['CACHE']['DRIVER'] = $post['cache_type'];
                $parse['CACHE']['HOSTNAME'] = $post['cache_host'];
                $parse['CACHE']['HOSTPORT'] = $post['cache_port'];
                $parse['CACHE']['SELECT'] = max ($post['cache_select'], 1);
                $parse['CACHE']['USERNAME'] = $post['cache_user'];
                $parse['CACHE']['PASSWORD'] = $post['cache_pass'];
                $content = parse_array_ini ($parse);
                if (write_file ($env, $content)) {
                    Cache::set ('redis-sys_', $post, config ('cookie.expire'));
                }
            } catch (\Throwable $th) {
                return $this->error ($th->getMessage ());
            }
            return $this->success ('保存成功!');
        }
    }

    /**
     * FTP测试上传
     */
    public function testFtp ()
    {
        if (request ()->isPost ()) {
            if (Ftp::instance ()->ftpTest (input ())) {
                return $this->success ('上传测试成功！');
            }
        }
        return $this->error ('上传测试失败！');
    }

    /**
     * 邮件测试
     */
    public function testEmail ()
    {
        if (request ()->isPost ()) {
            $info = Email::instance ()->testEMail (input ());
            $info === true ? $this->success ('测试邮件发送成功！') : $this->error ($info);
        }
    }

    /**
     * 缓存测试
     */
    public function testCache ()
    {
        if (request ()->isPost ()) {
            $param = input ();
            if (!isset($param['type']) || empty($param['host']) || empty($param['port'])) {
                return $this->error ('参数错误!');
            }
            $options = [
                'host' => $param['host'],
                'port' => (int)$param['port'],
                'username' => $param['user'],
                'password' => $param['pass']
            ];
            try {
                if (strtolower ($param['type']) == 'redis') {
                    $drive = new Redis($options);
                } else {
                    $drive = new Memcached($options);
                }
            } catch (Throwable $th) {
                return $this->error ($th->getMessage ());
            }
            if ($drive->set ('test', 'cacheOK', 1000)) {
                return $this->success ('缓存测试成功！');
            } else {
                return $this->error ('缓存测试失败！');
            }
        }
        return false;
    }
}