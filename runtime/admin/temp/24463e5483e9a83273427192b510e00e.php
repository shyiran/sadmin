<?php /*a:1:{s:45:"D:\SwiftAdmin\app\admin\view\index\index.html";i:1659669829;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SwiftAdmin 后台管理开发框架</title>
    <link href="/favicon.ico" rel="icon">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link href="/static/system/layui/css/layui.css?v=<?php echo release(); ?>" rel="stylesheet" type="text/css"/>
    <link href="/static/system/css/style.css?v=<?php echo release(); ?>" rel="stylesheet" type="text/css"/>
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
    var _upload_chunkSize = <?php echo saenv('upload_chunk_size'); ?>;
</script>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <!-- 头部区域 -->
    <div class="layui-header">
        <!-- 头部导航区域 -->
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item layadmin-flexible" lay-unselect>
                <a href="javascript:;" sa-event="flexible" title="<?php echo __('侧边伸缩'); ?>">
                    <i class="layui-icon layui-icon-shrink-right" id="flexible"></i>
                </a>
            </li>
            <li class="layui-nav-item" lay-unselect>
                <a href="javascript:;" sa-event="refresh" title="<?php echo __('刷新'); ?>">
                    <i class="layui-icon layui-icon-refresh"></i>
                </a>
            </li>
            <!-- // 多系统模式下元素 -->
            <div class="layui-nav-head">
                <ul class="layui-nav layui-nav-top" lay-filter="lay-side-menu"></ul>
            </div>
        </ul>

        <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">

            <li class="layui-nav-item layui-hide-xs" lay-unselect>
                <a href="/" target="_blank" title="<?php echo __('主页'); ?>">
                    <i class="layui-icon fa-home"></i>
                </a>
            </li>

            <li class="layui-nav-item layui-hide-xs" lay-unselect>
                <a href="javascript:;" sa-event="fullscreen" title="<?php echo __('全屏'); ?>">
                    <i class="layui-icon layui-icon-screen-full"></i>
                </a>
            </li>

            <li class="layui-nav-item layui-hide-xs">
                <a id="language" href="javascript:;" title="<?php echo __('语言'); ?>">
                    <i class="layui-icon fa-language"></i>
                </a>
            </li>
            <li class="layui-nav-item" lay-unselect>
                <a href="javascript:;" sa-event="message" lay-text="<?php echo __('消息中心'); ?>"
                   data-url="<?php echo url('/system.admin/message',[],false); ?>">
                    <i class="layui-icon fa-bell-o"></i>
                    <!-- 如果有新消息，则显示小圆点 -->
                    <span class="layui-badge-dot"></span>
                </a>

            </li>
            <li class="layui-nav-item" lay-unselect>
                <a href="javascript:;">
                    <img src="<?php echo htmlentities($AdminLogin['face']); ?>" class="layui-nav-img">
                    <cite id="username"><?php echo htmlentities($AdminLogin['name']); ?></cite>
                </a>
                <!-- 后台的个人中心主页 -->
                <dl class="layui-nav-child" id="userHome" style="text-align: center;">
                    <dd><a sa-event="tabs" data-url="<?php echo url('/system.admin/center',[],false); ?>"
                           data-title="<?php echo __('用户中心'); ?>"><?php echo __('个人资料'); ?></a></dd>
                    <dd><a sa-event="pwd" data-url="<?php echo url('/system.admin/pwd',[],false); ?>"><?php echo __('修改密码'); ?></a></dd>
                    <dd><a id="clearCache" data-url="<?php echo url('/system.admin/clear',[],false); ?>"><?php echo __('清除缓存'); ?></a></dd>
                    <hr>
                    <dd><a sa-event="logout" data-url="<?php echo url('/login/logout',[],false); ?>"><?php echo __('退出'); ?></a></dd>
                </dl>
            </li>

            <li class="layui-nav-item layui-hide-xs" lay-unselect>
                <a href="javascript:;" sa-event="theme" data-url="<?php echo url('/system.admin/theme',[],false); ?>"><i
                        class="layui-icon layui-icon-more-vertical"></i></a>
            </li>
            <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-unselect>
                <a href="javascript:;" sa-event="more"><i class="layui-icon layui-icon-more-vertical"></i></a>
            </li>
        </ul>
    </div>

    <!-- 侧边菜单 -->
    <div class="layui-side layui-side-menu">
        <div class="layui-side-scroll">
            <div class="layui-logo" href="/">
                <img src="/static/system/images//logo.png?v=<?php echo release(); ?>" alt="" width="35" height="35">
                <h1>Swift Admin Pro</h1>
            </div>
            <!-- // 侧边菜单 -->
            <ul class="layui-nav layui-nav-tree" lay-shrink="all" lay-filter="lay-side-menu" lay-accordion="true"
                lay-statichtml="false"></ul>
        </div>
    </div>
    <!-- 内容主体区域 -->
    <div class="layui-body"></div>
    <!-- 底部固定区域 -->
    <div class="layui-footer"> copyright © <?php echo date('Y'); ?> <a href="http://www.swiftadmin.net" target="_blank">SwiftAdmin</a> all
        rights reserved.
        <span class="layui-layout-right" style="margin-right: 10px;">Build <?php echo release(); ?></span>
    </div>
    <!-- // 全局获取数据接口 -->
    <authorize id="authorize" data-url="<?php echo url('/system.admin/authorities'); ?>"></authorize>
</div>
<script src="/static/system/layui/layui.js?v=<?php echo release(); ?>"></script>
<script src="/static/system/js/common.js?v=<?php echo release(); ?>"></script>
<link href="/static/system/layui/css/font-awesome.css?v=<?php echo release(); ?>" rel="stylesheet" type="text/css"/>
<script>
    layui.use(['admin', 'mousewheel', 'dropdown'], function () {
        let $ = layui.jquery;
        let admin = layui.admin;
        let dropdown = layui.dropdown;
        let mousewheel = layui.mousewheel;

        admin.render({
            title: '<?php echo __("主页"); ?>',
            url: "<?php echo url('/index/console'); ?>"
        }, {menu: $('#authorize').data('url')});

        // 国际化语言
        dropdown.render({
            elem: '#language'
            , trigger: 'hover'
            , data: [{
                title: 'English',
                symbol: 'en-US'
            }, {
                title: '中文',
                symbol: 'zh-CN'
            }], click: function (obj) {

                // 避免重复
                let lang = admin.getStorage('language');
                if (lang === obj.symbol) {
                    return false;
                }
                $.get("<?php echo url('/system.admin/language'); ?>?l=" + obj.symbol, function (params) {

                    admin.changeI18n(obj.symbol);
                    admin.setStorage('language', obj.symbol);
                    location.reload();
                })
            }
        });

        $('.layui-nav-head').on('mousewheel', function (event) {
            $(this).stop();
            $(this).animate({'scrollLeft': $(this).scrollLeft() - event.deltaFactor * event.deltaY * 2}, 80);
            event.stopPropagation();
            event.preventDefault();
        });
    })
</script>
</body>
</html>
