<?php /*a:4:{s:45:"D:\SwiftAdmin\app\index\view\index\index.html";i:1659669829;s:47:"D:\SwiftAdmin\app\index\view\public\header.html";i:1659669829;s:44:"D:\SwiftAdmin\app\index\view\public\nav.html";i:1659669829;s:47:"D:\SwiftAdmin\app\index\view\public\footer.html";i:1659669829;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>SwiftAdmin 官方演示站</title>
<meta http-equiv="Cache-Control" content="no-transform " />
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-status-bar-style" content="black"> 
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="/static/js/layui/css/layui.css">
<link rel="stylesheet" href="/static/css/style.css?v=<?php echo release(); ?>">
<script src="/static/js/layui/layui.js"></script>
<script src="/static/js/common.js?v=<?php echo release(); ?>"></script>
<!--[if lt IE 9]>
  <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<![endif]--> 
</head>
<body>
<div id="header">
		<div class="layui-container" >
		<div class="layui-logo">
			<a href="/"><img src="/static/system/images/logo.png" alt="logo" height="26">SwiftAdmin</a>
		</div>
		<ul class="layui-nav">
			<li class="layui-nav-item active"><a href="/" class="nav-link">主页</a></li>
			<li class="layui-nav-item "><a href="#" onclick="layer.msg('感谢您使用SAPHP<br><br>您可以尽情在此框架上二次开发');" class="nav-link">关于</a></li>
			<li class="layui-nav-item "><a href="https://www.swiftadmin.net/plugin/" class="nav-link">插件市场</a></li>
			<li class="layui-nav-item layui-hide-xs"><a href="https://www.swiftadmin.net/agreement.html" class="nav-link">使用协议</a></li>
			<li class="layui-nav-item layui-hide-xs"><a href="https://doc.swiftadmin.net/help/" class="nav-link">帮助文档</a></li>
			<li class="layui-nav-item layui-hide-xs"><a href="https://ask.swiftadmin.net/" class="nav-link">社区中心</a></li>
			<li class="layui-nav-item layui-hide-xs"><a href="https://qm.qq.com/cgi-bin/qm/qr?k=rUxEL3_DV8PnflvZiJamjED0dfHwpiMw&jump_from=webapi" target="_blank" class="nav-link">联系我们</a></li>
		</ul>

		<div class="layui-nav layui-hide-xs fr" id="login">
			<?php if(!(empty($user['id']) || (($user['id'] instanceof \think\Collection || $user['id'] instanceof \think\Paginator ) && $user['id']->isEmpty()))): ?> <li class="layui-nav-item"><a class="" href="/user/index" >会员中心</a></li> <?php else: ?>
			<li class="layui-nav-item"><a href="javascript:;" lay-open data-title="用户注册" data-area="490px" data-url="/user/register" >注册</a></li>
			<li class="layui-nav-item"><a href="javascript:;" lay-open data-title="用户登录" data-area="450px,420px" data-url="/user/login" >登录</a></li>
			<?php endif; ?>
		</div>
	</div>
</div>

<div id="content" >
	<div class="layui-container">
	  <div class="layui-row">
	    <div class="layui-col-md6">
	    	<div class="layui-swift-box"> 
				<h1>SwiftAdmin 极速开发框架</h1>
				<h1 style="font-size: 26px; font-weight: 300">基于ThinkPHP Layui 完美契合</h1>
				<p>SwiftAdmin框架主张简单就是高效的原则，在设计和运维上采用最精简最高效的做法去完成业务系统的需求，并且基于ant Design的设计原则，是一款优秀的前后台极速开发解决方案。相信你第一眼就有立刻想体验SwiftAdmin框架的冲动和热情！</p>
				<div class="layui-swift-desc">
					<a target="_blank"><img src="https://img.shields.io/badge/ThinkPHP-6LTS +-green.svg"></a>
					<a target="_blank"><img src="https://img.shields.io/badge/License-Apache2协议-red.svg"></a>
					<a target="_blank" href="https://gitee.com/meystack/swiftadmin/" rel="nofollow" style="margin-right: 50px">
						<img src="https://gitee.com/meystack/swiftadmin/badge/star.svg?theme=dark" alt="gitee star">
					</a>
				</div>

				<div class="layui-swift-images">
					<img src="/static/images/demo/1.png" >
					<img src="/static/images/demo/2.png" >
					<img src="/static/images/demo/3.png" >
					<img class="hidden" src="/static/images/demo/4.png" >
				</div>
	    	</div>
	    </div>

	    <div class="layui-col-md6">
	      <img src="/static/images/hero-img.png" width="90%" height="500" alt="">
	    </div>
	  </div>

	</div>
</div>

<div id="footer" >
	<div class="layui-footer" >
		<div style="text-align: center;"> copyright © 2020 www.swiftadmin.net all rights reserved.</div>
	</div>
</div>
</body>
<script>
	layui.use(['jquery','layer'],function(){
		var $ = layui.jquery;
		var layer = layui.layer;

		$('.layui-swift-images img').click(function(){
            layer.photos({
                photos: '.layui-swift-images',
                shadeClose: true,
                closeBtn: 2,
                anim: 10
            })
		})
	})
</script>	
</html>