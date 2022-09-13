<?php /*a:1:{s:47:"D:\SwiftAdmin\app\install\view\index\index.html";i:1659669829;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<title>SwiftAdmin安装向导</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-status-bar-style" content="black"> 
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="/static/js/layui/css/layui.css">
<link rel="stylesheet" href="/static/css/install.css?<?php echo config('app.version'); ?>">
<script src="/static/js/layui/layui.js"></script>
</head>
<body>

<div class="layui-header">
	<div class="layui-container">
		<h1 class="logo"><a href="https://www.swiftadmin.net"><img class="pic" src="/static/system/images//logo.png" alt=""><span>SwiftAdmin</span></a></h1>
		<div class="title">安装向导</div>
	</div>
</div>

<div class="layui-content">
	<div class="layui-container">
		<div class="layui-row">
			<div class="layui-col-md12">
				<div class="layui-card layui-fixed">
					<div class="layui-card-header">
						<span>用户协议</span>
						<span class="layui-card-version"><?php echo config('app.version'); ?></span>
					</div>
					<div class="layui-card-body">
						<div class="layui-textarea" style="height:500px; overflow: auto;">
							<div style="width: 96%;line-height: 30px;">
								SAPHP 即：SwiftAdmin极速后台开发框架（以下简称SAPHP）由MeyStack独立开发。著作权编号：2021SR0761953<br>MeyStack依法拥有SAPHP的所有版权和所有权益。本着共享开放的角度，MeyStack以开放源代码的形式发布本框架，您可以在遵守该协议的前提下使用SAPHP框架。
								自您安装使用SAPHP开始，您和SAPHP之间的合同关系自动成立，成为SAPHP用户（以下简称为用户）。除非您停止使用或与SAPHP有签署额外合同，您须认真遵循该用户协议约定的每一项条款。<br>
								官方地址：<a target="_blank" href="https://www.swiftadmin.net">www.swiftadmin.net</a><br>
								官方邮箱：coolsec@foxmail.com <br>
								官方社群：<a target="_blank" href="//jq.qq.com/?_wv=1027&k=gpmGDtxZ">SAPHP交流1群（68221484)</a> /  <a target="_blank" href="//jq.qq.com/?_wv=1027&k=LGqhtybt">SAPHP交流2群（68221585)</a> /  <a target="_blank" href="//jq.qq.com/?_wv=1027&k=mUywQfbU">SAPHP交流3群（68221618）</a>
								<p>一、协议中提到的名词约定</p>
								1.1	下述条款中所指SAPHP的标志包括如下方面：<br>
								SAPHP源代码及文档中关于SAPHP的版权提示、文字、图片和链接。<br>
								SAPHP运行时界面上呈现出来的有关SAPHP的文字、图片和链接。<br>
								1.2	不包括如下方面：<br>
								SAPHP提供的演示数据中关于SAPHP的文字、图片和链接。<br>
								<p>二、免责声明</p>
								2.1	用户出于自愿而使用本软件，必须了解使用本软件的风险，在尚未购买产品技术服务或商业授权之前，我们不承诺对免费用户提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。<br>
								2.2	电子文本形式的使用协议如同双方书面签署的协议一样，具有完全的和等同的法律效力。您一旦开始确认本协议并安装SAPHP，即被视为完全理解并接受本协议的各项条款，在享有以下条款授予的权力的同时，受到相关的约束和限制。<br>
								2.3	协议许可范围以外的行为，将直接违反本授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权利。<br>
								<p>三、协议许可的权利</p>
								3.1	如果您以学习或研究为目的使用SAPHP，SAPHP不对您做任何限制。<br>
								3.2 您可以在您个人任意数量的电脑上运行SAPHP，SAPHP不对电脑的数量做任何限制。<br>
								3.3 您可以对SAPHP源代码进行修改以适应您个人学习研究的要求，您做的改动无需对外发布。<br>
								3.4 SAPHP依法拥有SAPHP的所有版权和软件权益，未经商业授权，您无任何版权及软件相关权益。<br>
								<p>四、协议规定的约束和限制</p>
								4.1	当您开始将SAPHP用于企业内部管理使用，意味着已经商用，如去掉版权则需购买相应的商业授权 <br>
								<font color="red">4.2 SAPHP您可以自由使用，商业授权只是限制了SAPHP框架的标识！除本文条款外您无需担心法律风险！<br></font>
								4.3	未经官方许可，禁止在SAPHP的整体或任何部分基础上发展任何派生版本、修改版本或第三方版本用于重新分发,<br>包括但不限于基于SAPHP开发SAAS平台等相关服务。<br>
								4.4	如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回，并承担相应法律责任。<br>
								4.5 您使用SAPHP时，必须保留SAPHP的所有标志，不得以任何方式隐藏或遮掩任一标志。<br>
								<p>五、未尽事项</p>
								如果上述条款无法满足您使用SAPHP的要求，可联系SAPHP签署额外的合同以获得更灵活的授权许可。<br>
								<p>六、合同约束</p>
								如果您违反了该协议的任一条款，该用户协议将自动终止，您必须停止使用，SAPHP保留通过法律手段追究责任的权利。<br>
							</div>							
						</div> 
						   <div class="layui-center">
						   	<button type="button" onclick="window.location.href='/install.php/index/step1'" class="layui-btn layui-btn-normal">同意协议</button>
						   </div>
		    		</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<style>.layui-footer{    
		position: revert;
        padding: 0px;
    }</style>
<div class="layui-footer">copyright © 2020 SwiftAdmin all rights reserved.</div>
</body>
</html>