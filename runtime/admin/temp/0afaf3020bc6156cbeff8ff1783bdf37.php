<?php /*a:3:{s:47:"D:\SwiftAdmin\app\admin\view\index\console.html";i:1659669829;s:47:"D:\SwiftAdmin\app\admin\view\public\header.html";i:1659669829;s:47:"D:\SwiftAdmin\app\admin\view\public\footer.html";i:1659669829;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SwiftAdmin 后台管理开发框架</title>
	<link href="/favicon.ico" rel="icon">
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="/static/system/layui/css/layui.css?v=<?php echo release(); ?>" rel="stylesheet" type="text/css" />
	 <link href="/static/system/css/style.css?v=<?php echo release(); ?>" rel="stylesheet" type="text/css" />
	<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<script>
	var _global_ = {
		app: "<?php echo htmlentities((isset($app) && ($app !== '')?$app:'admin.php')); ?>",
		controller: "<?php echo htmlentities((isset($controller) && ($controller !== '')?$controller:'index')); ?>",
		action: "<?php echo htmlentities((isset($action) && ($action !== '')?$action:'index')); ?>",
		api: "<?php echo config('app.api_url'); ?>"
	};

	var _upload_chunkSize =  <?php echo saenv('upload_chunk_size'); ?>;
</script>

<body>
<style>
    .layui-row {
        overflow: hidden;
        margin-bottom: 10px;
    }

    .echartsOrder {
        margin-right: 10px;
    }

    .echartsOrder:hover, .echartsOrder.active {
        color: #1890ff;
    }
</style>

<div class="layui-fluid ">

    <div class="layui-row layui-col-space10">

        <div class="layui-col-md8">
            <!-- 填充内容 -->
            <div class="layui-card">
                <div class="layui-card-body" style="padding: 20px;">
                    <div class="layui-row">
                        <div class="layui-col-md8">
                            <img src="<?php echo htmlentities($AdminLogin['face']); ?>" class="layui-admin-avatar">
                            <div class="layui-admin-content">
                                <span class="h4">早安，<?php echo htmlentities((isset($AdminLogin['nickname']) && ($AdminLogin['nickname'] !== '')?$AdminLogin['nickname']:$AdminLogin['name'])); ?>，开始您一天的工作吧！</span>
                                <span>今日多云转阴，18℃ - 22℃，出门记得穿外套哦~</span>
                            </div>
                        </div>
                        <div class="layui-col-md4">
                            <div class="layui-admin-workplace">
                                <div class="workplace-header">
                                    <span><i class="layui-icon layui-icon-list"></i>文章数</span>
                                </div>
                                <div class="workplace-content"><?php echo htmlentities((isset($workplace['article']) && ($workplace['article'] !== '')?$workplace['article']:26)); ?></div>
                            </div>

                            <div class="layui-admin-workplace">
                                <div class="workplace-header">
                                    <span><i class="layui-icon layui-icon-date date"></i>待审核</span>
                                </div>
                                <div class="workplace-content"><?php echo htmlentities((isset($workplace['check']) && ($workplace['check'] !== '')?$workplace['check']:"12/56")); ?></div>
                            </div>
                            <div class="layui-admin-workplace">
                                <div class="workplace-header">
                                    <span><i class="layui-icon layui-icon-notice notice"></i>评论数</span>
                                </div>
                                <div class="workplace-content"><?php echo htmlentities((isset($workplace['comment']) && ($workplace['comment'] !== '')?$workplace['comment']:"2,352")); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-body" style="padding: 20px;">
                    <div style="height: 78px">
                        <ul>
                            <a href="http://www.rookiew.com" class="workplace-action" target="_blank"
                               title="菜鸟教程 - 免费基础编程教学">菜鸟教程 ❤️</a>
                            <a href="https://www.yingtwo.com" class="workplace-action" target="_blank"
                               title="高性价比云服务器">云服务器 <span class="layui-badge"
                                                           style="height: 11px;line-height:11px;font-size:10px;">HOT</span></a>
                            <a href="javascript:;" class="workplace-action" sa-event="tabs"
                               data-url="<?php echo url('/system.plugin/index'); ?>"
                               title="插件管理">插件管理</a>
                            <a href="javascript:;" class="workplace-action" sa-event="tabs"
                               data-url="<?php echo url('/system.attachment/index'); ?>"
                               title="附件管理">附件管理</a>
                            <a href="javascript:;" class="workplace-action" sa-event="tabs"
                               data-url="<?php echo url('/system.dictionary/index'); ?>"
                               title="字典管理">字典管理</a>
                            <a href="javascript:;" class="workplace-action" sa-event="tabs"
                               data-url="<?php echo url('/system.department/index'); ?>"
                               title="部门管理">部门管理</a>
                            <a href="javascript:;" class="workplace-action" sa-event="tabs"
                               data-url="<?php echo url('/system.jobs/index'); ?>"
                               title="岗位管理">岗位管理</a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="layui-row layui-col-space10" style="margin-bottom: 0;">

        <div class="layui-col-md4">
            <div class="layui-row layui-col-space10" style="margin-bottom: 5px;">
                <div class="layui-col-xs6 layui-col-sm6">
                    <div class="layui-card smallblock" sa-event="tabs" data-url="<?php echo url('/system.user/index'); ?>"
                         data-title="<?php echo __('会员管理'); ?>">
                        <div class="layui-card-body">
                            <div class="layui-small-block">
                                <div><i class="layui-icon fa-user"></i></div>
                                <div class="layui-small-block-title">用户</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-col-xs6 layui-col-sm6">
                    <div class="layui-card smallblock" sa-event="tabs" data-url="<?php echo url('/index/analysis'); ?>"
                         data-title="<?php echo __('分析页'); ?>">
                        <div class="layui-card-body">
                            <div class="layui-small-block">
                                <div><i class="layui-icon fa-line-chart " style="color: #b0e689"></i></div>
                                <div class="layui-small-block-title">分析</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-col-md4">
            <div class="layui-row layui-col-space10" style="margin-bottom: 5px;">
                <div class="layui-col-xs6 layui-col-sm6">
                    <div class="layui-card smallblock" sa-event="tabs" data-url="<?php echo url('/index/monitor'); ?>"
                         data-title="<?php echo __('监控页'); ?>">
                        <div class="layui-card-body">
                            <div class="layui-small-block">
                                <div><i class="layui-icon layui-icon-chart-screen" style="color: #fe9c6e"></i></div>
                                <div class="layui-small-block-title">监控</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-col-xs6 layui-col-sm6">
                    <div class="layui-card smallblock" sa-event="tabs" data-url="<?php echo url('/system.dictionary/index'); ?>"
                         data-title="<?php echo __('字典管理'); ?>">
                        <div class="layui-card-body">
                            <div class="layui-small-block">
                                <div><i class="layui-icon fa-th-list" style="color: #b37eeb"></i></div>
                                <div class="layui-small-block-title">字典</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-col-md4">
            <div class="layui-row layui-col-space10" style="margin-bottom: 5px;">
                <div class="layui-col-xs6 layui-col-sm6">
                    <div class="layui-card smallblock" sa-event="tabs" data-url="<?php echo url('/system.systemLog/index'); ?>"
                         data-title="<?php echo __('操作日志'); ?>">
                        <div class="layui-card-body">
                            <div class="layui-small-block">
                                <div><i class="layui-icon fa-file-text" style="color: #88e4de"></i></div>
                                <div class="layui-small-block-title">日志</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-col-xs6 layui-col-sm6">
                    <div class="layui-card smallblock" sa-event="tabs" data-url="<?php echo url('/index/basecfg'); ?>"
                         data-title="<?php echo __('基本设置'); ?>">
                        <div class="layui-card-body">
                            <div class="layui-small-block">
                                <div><i class="layui-icon fa-gear" style="color: #ffc069"></i></div>
                                <div class="layui-small-block-title">设置</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="layui-row layui-col-space10">

        <div class="layui-col-md8">
            <div class="layui-card">
                <div class="layui-card-header">注册登录概览
                    <span class="pull-right">
                        <a class="echartsOrder" data-cycle="week">周</a>
                        <a class="echartsOrder" data-cycle="month">月</a>
                        <a class="echartsOrder" data-cycle="year">年</a>
                    </span>

                </div>
                <div class="layui-card-body">
                    <div id="RegisterCharts" style="height: 250px"></div>
                    <div id="RegisterChartsData" style="display: none"><?php echo $RegisterChartsOptions; ?></div>
                </div>
            </div>
        </div>
        <div class="layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-header">用户统计（组）</div>
                <div class="layui-card-body">
                    <div id="userGroupCharts" style="height: 250px"></div>
                    <div id="userGroupData" style="display: none"><?php echo $userGroupData; ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-row layui-col-space10">

        <div class="layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-header">热搜统计 (CMS)</div>
                <div class="layui-card-body">
                    <div id="searchWordCharts" style="height: 250px;"></div>
                    <div id="searchWordData" style="display: none"><?php echo $searchWords; ?></div>
                </div>
            </div>
        </div>

        <div class="layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-header">资产报表</div>
                <div class="layui-card-body" style="height: 250px;overflow: hidden">

                    <div class="layui-col-xs4 layui-col-sm4">
                        <div class="layui-card smallblock">
                            <div class="layui-card-body">
                                <div class="layui-small-block">
                                    <div><i class="layui-icon fa-plug"></i></div>
                                    <div class="layui-small-block-title">本地插件 <?php echo htmlentities($assetsInfo['pluginCount']); ?> 个</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="layui-col-xs4 layui-col-sm4">
                        <div class="layui-card smallblock">
                            <div class="layui-card-body">
                                <div class="layui-small-block">
                                    <div><i class="layui-icon fa-database"></i></div>
                                    <div class="layui-small-block-title">数据表 <?php echo htmlentities($assetsInfo['tableCount']); ?> 张</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="layui-col-xs4 layui-col-sm4">
                        <div class="layui-card smallblock">
                            <div class="layui-card-body">
                                <div class="layui-small-block">
                                    <div><i class="layui-icon fa-file"></i></div>
                                    <div class="layui-small-block-title">附件记录 <?php echo htmlentities($assetsInfo['attachmentCount']); ?> 条</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="layui-col-xs4 layui-col-sm4">
                        <div class="layui-card smallblock">
                            <div class="layui-card-body">
                                <div class="layui-small-block">
                                    <div><i class="layui-icon fa-codepen" style="color: #ee6666"></i></div>
                                    <div class="layui-small-block-title">正在运行 <?php echo htmlentities($assetsInfo['pluginRunning']); ?> 个</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="layui-col-xs4 layui-col-sm4">
                        <div class="layui-card smallblock">
                            <div class="layui-card-body">
                                <div class="layui-small-block">
                                    <div><i class="layui-icon fa-hdd-o" style="color: #ee6666"></i></div>
                                    <div class="layui-small-block-title">数据库 <?php echo htmlentities($assetsInfo['dbSize']); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="layui-col-xs4 layui-col-sm4">
                        <div class="layui-card smallblock">
                            <div class="layui-card-body">
                                <div class="layui-small-block">
                                    <div><i class="layui-icon fa-mixcloud" style="color: #ee6666"></i></div>
                                    <div class="layui-small-block-title">附件大小 <?php echo htmlentities($assetsInfo['attachmentSize']); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="layui-col-md4">
            <div class="layui-card" id="console">
                <div class="layui-card-header">DEVOPS 统计<span class="layui-badge layui-badge-blue pull-right">总</span></div>
                <div class="layui-card-body">
                    <div id="devOpsCharts" style="height: 250px;"></div>
                    <div id="devOpsData" style="display: none"><?php echo $devOpsData; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/static/system/module/echarts/echarts.js"></script>
<script src="/static/system/module/echarts/echarts-wordcloud.js"></script>
<script src="/static/system/module/echarts/china.js"></script>

<!--// 加载Markdown编辑器-->
<script src="/static/js/markdown/cherry-markdown.min.js?v=<?php echo release(); ?>"></script>
<link href="/static/js/markdown/cherry-markdown.css?v=<?php echo release(); ?>" rel="stylesheet" type="text/css"/>
<!--// 加载CommonJS-->
<script src="/static/system/layui/layui.js?v=<?php echo release(); ?>"></script>
<script src="/static/system/js/common.js?2v=<?php echo release(); ?>"></script>

<!-- // 全局加载第三方JS -->
<script src="/static/system/js/cascadata.js?v=<?php echo release(); ?>"></script>
<script src="/static/js/tinymce/tinymce.min.js?v=<?php echo release(); ?>"></script>
<script src="/static/system/module/xmselect/xmselect.js?v=<?php echo release(); ?>"></script>
<!-- // 加载font-awesome图标 -->
<link href="/static/system/layui/css/font-awesome.css?v=<?php echo release(); ?>" rel="stylesheet" type="text/css" />

<script>
    layui.use(['jquery','layer'], function () {

        let $ = layui.jquery;
        let layer = layui.layer;

        /**
         * 用户统计报表
         * @type {string}
         */
        let RegisterChartsCharts = echarts.init(document.getElementById('RegisterCharts'));
        RegisterChartsCharts.setOption(JSON.parse($('#RegisterChartsData').text()));
        /**
         * 查询注册报表
         * @param page
         */
        $('.echartsOrder').click(function (e) {
            let that = $(this);
            let cycle = $(this).data('cycle');
            $.ajax({
                url: '<?php echo url("/index/console"); ?>',
                type: 'post',
                data: {cycle: cycle},
                dataType: 'json',
                success: function (res) {
                    if (res.code === 200) {
                        RegisterChartsCharts.setOption(res.data);
                        $('.echartsOrder').removeClass('active');
                        $(that).addClass('active');
                    }
                    else {
                        layer.info(res.msg);
                    }
                }
            })
        })

        /**
         * 组别报表
         * @type {[type]}
         */
        let userGroupCharts = echarts.init(document.getElementById('userGroupCharts'));
        let userGroupOptions = {
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'vertical',
                left: '30px',
                top: '30px'
            },
            series: [
                {
                    name: '用户组别',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: '14px',
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: JSON.parse($('#userGroupData').text())
                }
            ]
        }
        userGroupCharts.setOption(userGroupOptions);

        /**
         * 搜索词报表
         * @type {[type]}
         */
        var searchWordCharts = echarts.init(document.getElementById('searchWordCharts'));
        var searchWordOption = {
            tooltip: {show: true},
            series: [{
                type: 'wordCloud',
                shape: 'circle',
                keepAspect: false,
                left: 'center',
                top: 'center',
                width: '80%',
                height: '80%',
                right: null,
                bottom: null,
                sizeRange: [12, 23],
                rotationRange: [-90, 90],
                rotationStep: 45,
                gridSize: 6,
                drawOutOfBound: false,
                layoutAnimation: true,
                textStyle: {
                    color: function () {
                        // Random color
                        return 'rgb(' + [
                            Math.round(Math.random() * 160),
                            Math.round(Math.random() * 160),
                            Math.round(Math.random() * 160)
                        ].join(',') + ')';
                    }
                },
                emphasis: {shadowBlur: 10, shadowColor: '#333'},
                data: JSON.parse($('#searchWordData').text())
            }]
        };

        searchWordCharts.setOption(searchWordOption);
        /**
         * 系统数据报表
         * @type {[type]}
         */
        let devOpsCharts = echarts.init(document.getElementById('devOpsCharts'));
        let devOpsOptions = {
            color: ['#1890ff'],
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                }
            },
            xAxis: [
                {
                    type: 'category',
                    data: ['全部日志', '错误日志', '常规日志', '邮件验证','手机验证',  '用户统计', '登录绑定'],
                    axisTick: {
                        alignWithLabel: true
                    }
                }
            ],
            yAxis: {
                type: 'value'
            },
            grid: {
                left: '3%',
                right: '3%',
                bottom: '5%',
                top: '3%',
                containLabel: true
            },
            series: [
                {
                    type: 'bar',
                    barWidth: '50%',
                    data: JSON.parse($('#devOpsData').text())
                }
            ]
        };

        devOpsCharts.setOption(devOpsOptions);
        // 窗口大小改变事件
        window.onresize = function () {
            RegisterChartsCharts.resize();
            devOpsCharts.resize();
            searchWordCharts.resize();
            userGroupCharts.resize();
        };
    })

</script>
</body>
</html>
