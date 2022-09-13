<?php /*a:3:{s:47:"D:\SwiftAdmin\app\admin\view\index\basecfg.html";i:1659669829;s:47:"D:\SwiftAdmin\app\admin\view\public\header.html";i:1659669829;s:47:"D:\SwiftAdmin\app\admin\view\public\footer.html";i:1659669829;}*/ ?>
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
    @media screen and (min-width: 768px) {
        .layui-form-item .layui-input-inline {
            width: 300px;
        }

        table {
            border: 1px solid #e6e6e6;
        }

        table td {
            padding: 5px;
            padding-left: 8px;
            border: 1px solid #e6e6e6;
        }

        table td .layui-form-radio>i {
            font-size: 18px;
        }

        table td .layui-form-radio {
            margin: 0;
            padding: 0;
        }

        .layui-colla-title {
            height: 50px;
            line-height: 50px;
            padding-left: 10px;
        }

        .layui-colla-content {
            overflow: hidden;
            /* padding: 20px; */
        }

        .layui-colla-title {
            background-color: #fff;
        }

        .layui-colla-content,
        .layui-colla-item {
            border: none;
            /* margin-bottom: 5px; */
        }

        .layui-collapse .layui-colla-item .layui-colla-title i.layui-icon {
            margin-right: 5px;
        }

        .layui-colla-icon {
            display: none;
        }

        .layui-card-header .layui-icon {
            left: 5px;
            position: unset;
            margin-right: 5px;
        }
    }
</style>
<div class="layui-fluid">
    <div class="layui-row">
        <div class="layui-card">
            <div class="layui-card-body">
                <form id="baseForm" action="<?php echo url('/index/baseSet'); ?>" lay-filter="baseForm"
                    class="layui-form layui-row model-form" wid100>
                    <div class="layui-tab layui-tab-brief">

                        <ul class="layui-tab-title">
                            <li class="layui-this"><?php echo __('网站设置'); ?></li>
                            <li><?php echo __('核心设置'); ?></li>
                            <li><?php echo __('附件设置'); ?></li>
                            <li><?php echo __('图片水印'); ?></li>
                            <li><?php echo __('视频设置'); ?></li>
                            <li><?php echo __('接口配置'); ?></li>
                            <li><?php echo __('用户中心'); ?></li>
                            <li><?php echo __('自定义变量'); ?></li>
                        </ul>

                        <!-- // 基础设置开始 -->
                        <div class="layui-tab-content">

                            <div class="layui-tab-item layui-show">

                                <div class="layui-form-item ">
                                    <label class="layui-form-label"><?php echo __('网站名称'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="site_name" autocomplete="off"
                                            value="<?php echo htmlentities($config['site_name']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux"> <i class="layui-icon layui-icon-about"
                                            lay-tips="* 网站的标题，适用于全站变量"></i> </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('网站域名'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="site_url" autocomplete="off" value="<?php echo htmlentities($config['site_url']); ?>"
                                            class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux"> * <?php echo __('不带HTTP网站地址。'); ?></div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('站点LOGO'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="site_logo" value="<?php echo htmlentities($config['site_logo']); ?>"
                                            placeholder="请上传站点LOGO图" class="layui-input logo">
                                    </div>
                                    <button type="button" class="layui-btn layui-btn-normal" lay-upload="logo"
                                        data-url="<?php echo url('/ajax/upload'); ?>?action=logo" >
                                        <i class="layui-icon layui-icon-upload"></i><?php echo __('上传图片'); ?>
                                    </button>
                                </div>

                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <div class="layui-upload-logo">
                                            <dl>
                                                <dt> <img class="logo" src="<?php echo htmlentities($config['site_logo']); ?>" alt="<?php echo __('站点LOGO'); ?>">
                                                </dt>
                                                <dd class="layui-badge"
                                                    onclick="javascript:layer.msg('好像没写代码！','error')"><?php echo __('删除'); ?></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('网站HTTP地址'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="site_http" autocomplete="off"
                                            value="<?php echo htmlentities($config['site_http']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('网站HTTP/HTTPS地址，结尾必需加斜杆 /。'); ?>
                                    </div>
                                </div>

                                <div class="layui-form-item">

                                    <label class="layui-form-label"><?php echo __('手机版'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="radio" name="site_state" data-display="mobile"
                                            lay-filter="radioStatus" value="0" title="<?php echo __('关闭'); ?>" <?php if($config['site_state'] == 0): ?> checked <?php endif; ?>>
                                        <input type="radio" name="site_state" data-display="mobile"
                                            lay-filter="radioStatus" value="1" title="<?php echo __('开启'); ?>" <?php if($config['site_state'] == 1): ?> checked <?php endif; ?> >
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('是否开启手机版模式'); ?></div>
                                </div>

                                <div class="mobile" <?php if($config['site_state'] == '0'): ?> style="display:none;"
                                    <?php endif; ?> >

                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo __('手机版类型'); ?></label>
                                        <div class="layui-input-inline">
                                            <input type="radio" name="site_type" style="clear: both;" value="1"
                                                title="<?php echo __('自适应'); ?>" <?php if($config['site_type'] == '1'): ?>
                                            checked <?php endif; ?> >
                                            <input type="radio" name="site_type" value="0" title="<?php echo __('独立域名'); ?>" <?php if($config['site_type'] == '0'): ?> checked <?php endif; ?>>
                                        </div>
                                        <div class="layui-form-mid layui-word-aux">* <?php echo __('代码自适应请配置手机版模板，域名则会主动跳转'); ?>
                                        </div>
                                    </div>

                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo __('手机版域名'); ?></label>
                                        <div class="layui-input-inline">
                                            <input type="text" name="site_mobile" autocomplete="off"
                                                value="<?php echo htmlentities($config['site_mobile']); ?>" class="layui-input">
                                        </div>
                                        <div class="layui-form-mid layui-word-aux">* <?php echo __('手机版域名，留空为代码自适应'); ?></div>
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('备案信息'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="site_icp" autocomplete="off" value="<?php echo htmlentities($config['site_icp']); ?>"
                                            class="layui-input">
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('站长邮箱'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="site_email" autocomplete="off"
                                            value="<?php echo htmlentities($config['site_email']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux"> <i class="layui-icon layui-icon-about"
                                            lay-tips="* <?php echo __('用于接受系统反馈邮件，可以单独设置！'); ?>"></i> </div>
                                </div>

                                <div class="layui-form-item layui-col-md5">
                                    <label class="layui-form-label"><?php echo __('关键字'); ?></label>
                                    <div class="layui-input-block">
                                        <input type="text" name="site_keyword" autocomplete="off"
                                            value="<?php echo htmlentities($config['site_keyword']); ?>" class="layui-input">
                                    </div>
                                </div>

                                <div class="layui-form-item layui-col-md5">
                                    <label class="layui-form-label"><?php echo __('网站描述'); ?></label>
                                    <div class="layui-input-block">
                                        <input type="text" name="site_description" autocomplete="off"
                                            value="<?php echo htmlentities($config['site_description']); ?>" class="layui-input">
                                    </div>
                                </div>

                                <div class="layui-form-item layui-col-md5">
                                    <label class="layui-form-label"><?php echo __('统计代码'); ?></label>
                                    <div class="layui-input-block">
                                        <textarea name="site_total" class="layui-textarea"
                                            placeholder="<?php echo __('请输入第三方统计代码'); ?>"><?php echo htmlentities($config['site_total']); ?></textarea>
                                    </div>
                                </div>
                                <div class="layui-form-item layui-col-md5">
                                    <label class="layui-form-label"><?php echo __('版权信息'); ?></label>
                                    <div class="layui-input-block">
                                        <textarea name="site_copyright" class="layui-textarea"
                                            placeholder="<?php echo __('请输入网站版权信息'); ?>"><?php echo htmlentities($config['site_copyright']); ?></textarea>
                                    </div>
                                </div>

                            </div>
                            <!-- // 核心设置开始 -->
                            <div class="layui-tab-item">

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('加密KEY'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="auth_key" autocomplete="off" value="<?php echo htmlentities($config['auth_key']); ?>"
                                            class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">
                                        <i class="layui-icon layui-icon-vercode"
                                            lay-tips="* <?php echo __('系统全局加密的KEY，初始化安装自动生成！'); ?>"></i>
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('全文检索功能'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="radio" name="full_status"
                                               value="1" title="<?php echo __('开启'); ?>"  <?php if($config['full_status'] == 1): ?> checked <?php endif; ?> >
                                        <input type="radio" name="full_status"
                                               value="0" title="<?php echo __('关闭'); ?>"  <?php if($config['full_status'] == 0): ?> checked <?php endif; ?>>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux"> <font color="red">* <?php echo __('开启后请安装XS/ES服务器，如不需要请关闭！！'); ?></font> </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('编辑器'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="radio" name="editor"
                                               value="lay-editor" title="<?php echo __('常规'); ?>"  <?php if($config['editor'] == 'lay-editor'): ?> checked <?php endif; ?> >
                                        <input type="radio" name="editor"
                                               value="lay-markdown" title="<?php echo __('MarkDown'); ?>"  <?php if($config['editor'] == 'lay-markdown'): ?> checked <?php endif; ?>>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux"> <font color="red">* <?php echo __('请在切换选项后清空系统缓存'); ?></font> </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('用户管理日志'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="radio" name="system_logs" value="1" title="开启" <?php if($config['system_logs'] == 1): ?> checked <?php endif; ?> >
                                        <input type="radio" name="system_logs" value="0" title="关闭" <?php if($config['system_logs'] == 0): ?> checked <?php endif; ?>>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('记录用户管理后台操作日志'); ?></div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('系统错误日志'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="radio" name="system_exception" value="1" title="开启" <?php if($config['system_exception'] == 1): ?> checked <?php endif; ?> >
                                        <input type="radio" name="system_exception" value="0" title="关闭" <?php if($config['system_exception'] == 0): ?> checked <?php endif; ?>>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">
                                        <font color="red">* <?php echo __('系统全局错误异常记录，建议开启监测'); ?></font>
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('清理非本站链接'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="radio" name="site_clearLink" value="1" title="开启" <?php if($config['site_clearLink'] == 1): ?> checked <?php endif; ?> >
                                        <input type="radio" name="site_clearLink" value="0" title="关闭" <?php if($config['site_clearLink'] == 0): ?> checked <?php endif; ?>>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">
                                        <font color="red">* </font><?php echo __('开启后发送内容自动清理非本站链接'); ?>
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('缓存开关'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="radio" name="cache_status" data-display="cache_status"
                                            lay-filter="radioStatus" value="1" title="开启" <?php if($config['cache_status'] == 1): ?> checked <?php endif; ?> >
                                        <input type="radio" name="cache_status" data-display="cache_status"
                                            lay-filter="radioStatus" value="0" title="关闭" <?php if($config['cache_status'] == 0): ?> checked <?php endif; ?>>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('开启数据库缓存会提高网站性能！'); ?></div>
                                </div>

                                <div class="cache_status" <?php if($config['cache_status'] == '0'): ?>
                                    style="display:none;" <?php endif; ?> >
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo __('缓存方式'); ?></label>
                                        <div class="layui-input-inline">
                                            <select name="cache_type" data-display="cache_type" data-disable="file"
                                                lay-filter="selectStatus" class="ctype">
                                                <option value="file" <?php if($config['cache_type'] == 'file'): ?>
                                                    selected<?php endif; ?> >file</option>
                                                <option value="redis" <?php if($config['cache_type'] == 'redis'): ?>
                                                    selected<?php endif; ?> >redis</option>
                                                <option value="memcached" <?php if($config['cache_type'] == 'memcached'): ?>selected<?php endif; ?>
                                                    >memcached</option>
                                            </select>
                                        </div>
                                        <div class="layui-form-mid layui-word-aux">
                                            <i class="layui-icon layui-icon-about"
                                                lay-tips="<?php echo __('使用Redis缓存方式,出错会抛出Connection refused！'); ?>"></i>
                                        </div>
                                    </div>

                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo __('缓存时间'); ?></label>
                                        <div class="layui-input-inline">
                                            <input type="text" name="cache_time" autocomplete="off"
                                                value="<?php echo htmlentities($config['cache_time']); ?>" class="layui-input">
                                        </div>
                                        <div class="layui-form-mid layui-word-aux">* <?php echo __('单位 /秒'); ?></div>
                                    </div>

                                    <div class="cache_type" <?php if($config['cache_type'] == 'file' or $config['cache_type'] == ''): ?>
                                        style="display:none;" <?php endif; ?> >
                                        <div class="layui-form-item">
                                            <label class="layui-form-label"><?php echo __('服务器IP'); ?></label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="cache_host" placeholder="<?php echo __('缓存服务器IP'); ?>"
                                                    value="<?php echo htmlentities($config['cache_host']); ?>" class="layui-input chost">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label"><?php echo __('端 口'); ?></label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="cache_port" placeholder="<?php echo __('缓存服务器端口'); ?>"
                                                    value="<?php echo htmlentities($config['cache_port']); ?>" class="layui-input cport">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label"><?php echo __('数据库'); ?></label>
                                            <div class="layui-input-inline">
                                                <input type="number" name="cache_select" min="1" max="16"
                                                    placeholder="<?php echo __('缓存服务redis库 1- 16'); ?>"
                                                    value="<?php echo htmlentities($config['cache_select']); ?>" class="layui-input cuser">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label"><?php echo __('账 号'); ?></label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="cache_user" placeholder="<?php echo __('缓存服务账号,没有请留空'); ?>"
                                                    value="<?php echo htmlentities($config['cache_user']); ?>" class="layui-input cuser">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label"><?php echo __('密 码'); ?></label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="cache_pass" placeholder="<?php echo __('缓存服务密码,没有请留空'); ?>"
                                                    value="<?php echo htmlentities($config['cache_pass']); ?>" class="layui-input cpass">
                                            </div>
                                            <button type="button" class="layui-btn layui-btn-primary" lay-ajax=""
                                                data-url="<?php echo url('/index/testCache'); ?>"
                                                data-object="type:ctype,host:chost,port:cport,user:cuser,pass:cpass"><?php echo __('测试连接'); ?></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('关闭网站'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="radio" name="site_status" value="1" title="是" <?php if($config['site_status'] == 1): ?> checked <?php endif; ?> >
                                        <input type="radio" name="site_status" value="0" title="否" <?php if($config['site_status'] == 0): ?> checked <?php endif; ?> >
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('关闭网站，全站会显示关闭提示！'); ?></div>
                                </div>

                                <div class="layui-form-item layui-col-md5">
                                    <label class="layui-form-label"><?php echo __('提示信息'); ?></label>
                                    <div class="layui-input-block">
                                        <textarea id="site_notice" name="site_notice" lay-verify="siteClose"
                                            type="layui-textarea"><?php echo htmlentities($config['site_notice']); ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- // 附件设置开始 -->
                            <div class="layui-tab-item">

                                <div class="layui-form-item ">
                                    <label class="layui-form-label"><?php echo __('保存路径'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="upload_path" autocomplete="off"
                                            value="<?php echo htmlentities($config['upload_path']); ?>" class="layui-input">
                                    </div>
                                    <label class="layui-form-label"><?php echo __('附件保存风格'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="upload_style" autocomplete="off"
                                            value="<?php echo htmlentities($config['upload_style']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* 附件的保存路径和风格。<?php echo __('提示信息'); ?></div>
                                </div>
                                <div class="layui-form-item ">
                                    <label class="layui-form-label"><?php echo __('图片类型'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="upload_class[images]" autocomplete="off"
                                            value="<?php echo htmlentities($config['upload_class']['images']); ?>" class="layui-input">
                                    </div>
                                    <label class="layui-form-label"><?php echo __('视频/音频类型'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="upload_class[video]" autocomplete="off"
                                            value="<?php echo htmlentities($config['upload_class']['video']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('附件类型使用,符号分割！'); ?></div>
                                    <br /><br />
                                    <label class="layui-form-label"><?php echo __('文档类型'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="upload_class[document]" autocomplete="off"
                                            value="<?php echo htmlentities($config['upload_class']['document']); ?>" class="layui-input">
                                    </div>
                                    <label class="layui-form-label"><?php echo __('其他类型'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="upload_class[files]" autocomplete="off"
                                            value="<?php echo htmlentities($config['upload_class']['files']); ?>" class="layui-input">
                                    </div>
                                </div>


                                <div class="layui-form-item ">
                                    <label class="layui-form-label"><?php echo __('FTP附件'); ?></label>
                                    <div class="layui-input-inline">
                                        <select name="upload_ftp" data-display="upload_ftp" lay-filter="selectStatus">
                                            <option value="1" <?php if($config['upload_ftp'] == '1'): ?> selected=""
                                                <?php endif; ?> ><?php echo __('开启'); ?></option>
                                            <option value="0" <?php if($config['upload_ftp'] == '0'): ?> selected=""
                                                <?php endif; ?> ><?php echo __('关闭'); ?></option>
                                        </select>
                                    </div>
                                    <label class="layui-form-label"><?php echo __('是否自动删除'); ?></label>
                                    <div class="layui-input-inline">
                                        <select name="upload_del">
                                            <option value="1" <?php if($config['upload_del'] == '1'): ?> selected=""
                                                <?php endif; ?> ><?php echo __('开启'); ?></option>
                                            <option value="0" <?php if($config['upload_del'] == '0'): ?> selected=""
                                                <?php endif; ?> ><?php echo __('关闭'); ?></option>
                                        </select>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('是否上传至云空间后删除本地文件。不建议开启！'); ?></div>
                                </div>

                                <!-- FTP下载设置隐藏域  -->
                                <div class="layui-form-item upload_ftp" <?php if($config['upload_ftp'] == 0): ?>
                                    style="display:none;" <?php endif; ?> >
                                    <label class="layui-form-label"><?php echo __('FTP地址'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="upload_ftp_host" placeholder="<?php echo __('请输入FTP服务器地址'); ?>"
                                            value="<?php echo htmlentities($config['upload_ftp_host']); ?>" class="layui-input ftp_host">
                                    </div>
                                    <label class="layui-form-label"><?php echo __('FTP端口'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="upload_ftp_port" placeholder="<?php echo __('请输入FTP服务器端口'); ?>"
                                            value="<?php echo htmlentities($config['upload_ftp_port']); ?>" class="layui-input ftp_port">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('上传附件到FTP后，为预留备份可将自动删除关闭。'); ?></div>
                                    <br /><br />
                                    <label class="layui-form-label"><?php echo __('FTP用户名'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="upload_ftp_user" placeholder="<?php echo __('请输入FTP服务器用户'); ?>"
                                            value="<?php echo htmlentities($config['upload_ftp_user']); ?>" class="layui-input ftp_user">
                                    </div>
                                    <label class="layui-form-label"><?php echo __('FTP密码'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="upload_ftp_pass" placeholder="<?php echo __('请输入FTP服务器密码'); ?>"
                                            value="<?php echo htmlentities($config['upload_ftp_pass']); ?>" class="layui-input ftp_pass">
                                    </div>
                                    <button type="button" class="layui-btn layui-btn-primary" lay-ajax=""
                                        data-url="<?php echo url('/index/testFtp'); ?>"
                                        data-object="host:ftp_host,port:ftp_port,user:ftp_user,pass:ftp_pass"><?php echo __('测试连接'); ?></button>
                                </div>


                                <div class="layui-form-item ">
                                    <label class="layui-form-label"><?php echo __('远程图片地址'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="upload_http_prefix"
                                            placeholder="<?php echo __('非空则会自动增加远程图片地址'); ?>" value="<?php echo htmlentities($config['upload_http_prefix']); ?>"
                                            class="layui-input">
                                    </div>
                                    <label class="layui-form-label"><?php echo __('文件分片大小'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="number" name="upload_chunk_size"
                                               placeholder="<?php echo __('请输入文件分片大小'); ?>"
                                               value="<?php echo htmlentities($config['upload_chunk_size']); ?>"
                                               lay-verify="required"
                                               disabled
                                               class="layui-input layui-disabled">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">
                                        <font color="red">* <?php echo __('默认分片大小为2MB：单位(字节)'); ?></font>
                                    </div>
                                </div>

                                <div class="layui-card-header" style="margin-bottom: 20px;"><?php echo __('云附件配置'); ?></div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('存储设置'); ?></label>
                                    <div class="layui-input-inline">
                                        <select name="cloud_status" data-display="layui-cloud-oss"
                                            lay-filter="selectStatus">
                                            <option value="1" <?php if($config['cloud_status'] == '1'): ?> selected=""
                                                <?php endif; ?> ><?php echo __('开启'); ?></option>
                                            <option value="0" <?php if($config['cloud_status'] == '0'): ?> selected=""
                                                <?php endif; ?> ><?php echo __('关闭'); ?></option>
                                        </select>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">
                                        <font color="red">* <?php echo __('开启云对象存储后，FTP上传默认无效。'); ?></font>
                                    </div>
                                </div>

                                <div class="layui-cloud-oss" <?php if($config['cloud_status'] == '0'): ?>
                                    style="display:none;"<?php endif; ?> >
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo __('存储类型'); ?></label>
                                        <div class="layui-input-inline">
                                            <select name="cloud_type" data-selector="aliyun_oss,qcloud_oss"
                                                lay-filter="selectStatus">
                                                <option value="aliyun_oss" <?php if($config['cloud_type'] == 'aliyun_oss'): ?>
                                                    selected="" <?php endif; ?> ><?php echo __('阿里云OSS'); ?></option>
                                                <option value="qcloud_oss" <?php if($config['cloud_type'] == 'qcloud_oss'): ?>
                                                    selected="" <?php endif; ?> ><?php echo __('腾讯云COS'); ?></option>
                                            </select>
                                        </div>
                                        <div class="layui-form-mid layui-word-aux">* <?php echo __('目前支持阿里云OSS，腾讯云COS。'); ?></div>
                                    </div>

                                    <div class="aliyun_oss" <?php if($config['cloud_type'] != 'aliyun_oss'): ?>
                                        style="display:none;" <?php endif; ?> >
                                        <!-- 上传附件到阿里云OSS，请在阿里云OSS设置水印和微缩图。 -->
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">accessId</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="aliyun_oss[accessId]"
                                                    placeholder="<?php echo __('请输入accessId'); ?>"
                                                    value="<?php echo htmlentities($config['aliyun_oss']['accessId']); ?>" class="layui-input">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">* accessId</div>
                                        </div>

                                        <div class="layui-form-item">
                                            <label class="layui-form-label">accSecret</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="aliyun_oss[accessSecret]"
                                                    placeholder="<?php echo __('请输入accessSecret'); ?>"
                                                    value="<?php echo htmlentities($config['aliyun_oss']['accessSecret']); ?>" class="layui-input">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">* accessSecret</div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">bucket</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="aliyun_oss[bucket]"
                                                    placeholder="<?php echo __('请输入bucket'); ?>"
                                                    value="<?php echo htmlentities($config['aliyun_oss']['bucket']); ?>" class="layui-input">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">* bucket。 </div>
                                        </div>

                                        <div class="layui-form-item">
                                            <label class="layui-form-label">endpoint</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="aliyun_oss[endpoint]"
                                                    placeholder="<?php echo __('请输入endpoint'); ?>"
                                                    value="<?php echo htmlentities($config['aliyun_oss']['endpoint']); ?>" class="layui-input">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">* endpoint。 </div>
                                        </div>

                                        <div class="layui-form-item">
                                            <label class="layui-form-label">urls</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="aliyun_oss[url]" placeholder="url"
                                                    value="<?php echo htmlentities($config['aliyun_oss']['url']); ?>" class="layui-input">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">* <?php echo __('不要斜杠结尾，此处为URL地址域名。'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 腾讯云上传 -->
                                    <div class="qcloud_oss" <?php if($config['cloud_type'] != 'qcloud_oss'): ?>
                                        style="display:none;" <?php endif; ?> >

                                        <div class="layui-form-item">
                                            <label class="layui-form-label">app_id</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="qcloud_oss[app_id]"
                                                    placeholder="<?php echo __('请输入app_id'); ?>"
                                                    value="<?php echo htmlentities($config['qcloud_oss']['app_id']); ?>" class="layui-input">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">* app_id </div>
                                        </div>

                                        <div class="layui-form-item">
                                            <label class="layui-form-label">secret_id</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="qcloud_oss[secret_id]"
                                                    placeholder="<?php echo __('请输入secret_id'); ?>"
                                                    value="<?php echo htmlentities($config['qcloud_oss']['secret_id']); ?>" class="layui-input">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">*
                                                secret_id，https://console.cloud.tencent.com/developer</div>
                                        </div>

                                        <div class="layui-form-item">
                                            <label class="layui-form-label">secret_key</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="qcloud_oss[secret_key]"
                                                    placeholder="<?php echo __('请输入secret_key'); ?>"
                                                    value="<?php echo htmlentities($config['qcloud_oss']['secret_key']); ?>" class="layui-input">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">* secret_key </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">bucket</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="qcloud_oss[bucket]"
                                                    placeholder="<?php echo __('请输入bucket'); ?>"
                                                    value="<?php echo htmlentities($config['qcloud_oss']['bucket']); ?>" class="layui-input">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">* <?php echo __('存储桶名称
                                                格式：BucketName,不要带id'); ?></div>
                                        </div>

                                        <div class="layui-form-item">
                                            <label class="layui-form-label">region</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="qcloud_oss[region]"
                                                    placeholder="<?php echo __('请输入region'); ?>"
                                                    value="<?php echo htmlentities($config['qcloud_oss']['region']); ?>" class="layui-input">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">* <?php echo __('region,地区如ap-beijing'); ?>
                                            </div>
                                        </div>

                                        <div class="layui-form-item">
                                            <label class="layui-form-label">urls</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="qcloud_oss[url]" placeholder="url"
                                                    value="<?php echo htmlentities($config['qcloud_oss']['url']); ?>" class="layui-input">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">* <?php echo __('不要斜杠结尾，此处为URL地址域名。 '); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <!-- // 图片水印开始 -->
                            <div class="layui-tab-item">
                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('微缩图'); ?></label>
                                    <div class="layui-input-inline">
                                        <select name="upload_thumb" data-display="upload_thumb"
                                            lay-filter="selectStatus">
                                            <option value="1" <?php if($config['upload_thumb'] == '1'): ?> selected=""
                                                <?php endif; ?> ><?php echo __('开启'); ?></option>
                                            <option value="0" <?php if($config['upload_thumb'] == '0'): ?> selected=""
                                                <?php endif; ?> ><?php echo __('关闭'); ?></option>
                                        </select>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('上传图片是否自动生成微缩图'); ?></div>
                                </div>

                                <!-- 微缩图隐藏域  -->
                                <div class="layui-form-item upload_thumb" <?php if($config['upload_thumb'] == 0): ?>
                                    style="display:none;" <?php endif; ?> >
                                    <label class="layui-form-label"><?php echo __('宽度 * 高度'); ?></label>
                                    <div class="layui-input-inline" style="width: 145px;">
                                        <input type="text" name="upload_thumb_w" placeholder="<?php echo __('微缩图宽度'); ?>"
                                            value="<?php echo htmlentities($config['upload_thumb_w']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-input-inline" style="width: 145px;">
                                        <input type="text" name="upload_thumb_h" placeholder="<?php echo __('微缩图高度'); ?>"
                                            value="<?php echo htmlentities($config['upload_thumb_h']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('(按原图比率缩小/小于该指定大小的图片将不生成缩略图)'); ?>
                                    </div>
                                </div>

                                <div class="layui-form-item ">
                                    <label class="layui-form-label"><?php echo __('水印设置'); ?></label>
                                    <div class="layui-input-inline">
                                        <select name="upload_water" data-display="upload_water"
                                            lay-filter="selectStatus">
                                            <option value="1" <?php if($config['upload_water'] == '1'): ?> selected=""
                                                <?php endif; ?> ><?php echo __('开启'); ?></option>
                                            <option value="0" <?php if($config['upload_water'] == '0'): ?> selected=""
                                                <?php endif; ?> ><?php echo __('关闭'); ?></option>
                                        </select>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('(当水印图片约等于图片%40的时候不增加图片水印)'); ?>
                                    </div>
                                </div>

                                <!-- 水印设置隐藏域  -->
                                <div class="upload_water" <?php if($config['upload_water'] == 0): ?>
                                    style="display:none;" <?php endif; ?> >

                                    <div class="layui-form-item">

                                        <label class="layui-form-label"><?php echo __('水印类型'); ?></label>
                                        <div class="layui-input-inline">
                                            <input type="radio" name="upload_water_type" value="1" title="<?php echo __('文字水印'); ?>"
                                                <?php if($config['upload_water_type'] == 1): ?> checked <?php endif; ?> >
                                            <input type="radio" name="upload_water_type" value="0" title="<?php echo __('图片水印'); ?>"
                                                <?php if($config['upload_water_type'] == 0): ?> checked <?php endif; ?> >
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo __('水印文字'); ?></label>
                                        <div class="layui-input-inline">
                                            <input type="text" name="upload_water_font" placeholder="<?php echo __('水印文字'); ?>"
                                                value="<?php echo htmlentities($config['upload_water_font']); ?>" class="layui-input">
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo __('文字大小'); ?></label>
                                        <div class="layui-input-inline">
                                            <input type="text" name="upload_water_size" placeholder="<?php echo __('文字大小'); ?>"
                                                value="<?php echo htmlentities($config['upload_water_size']); ?>" class="layui-input">
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo __('文字颜色'); ?></label>
                                        <div class="layui-input-inline">
                                            <input type="text" name="upload_water_color" placeholder="<?php echo __('文字颜色'); ?>"
                                                value="<?php echo htmlentities($config['upload_water_color']); ?>"
                                                class="layui-input upload_water_color">
                                        </div>
                                        <div class="picker" lay-colorpicker="upload_water_color"
                                            data-value="<?php echo htmlentities($config['upload_water_color']); ?>"></div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo __('透明度'); ?></label>
                                        <div class="layui-input-inline">
                                            <div lay-slider="upload_water_pct"
                                                data-value="<?php echo htmlentities($config['upload_water_pct']); ?>"
                                                style="margin-top: 15px; margin-left: 3px;"></div>
                                            <input type="hidden" name="upload_water_pct"
                                                value="<?php echo htmlentities($config['upload_water_pct']); ?>"
                                                class="layui-input upload_water_pct">
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo __('水印图片'); ?></label>
                                        <div class="layui-input-inline">
                                            <input type="text" name="upload_water_img" placeholder="水印图片"
                                                value="<?php echo htmlentities($config['upload_water_img']); ?>"
                                                class="layui-input upload_water_img">
                                        </div>
                                        <button type="button" class="layui-btn layui-btn-normal"
                                            lay-upload="upload_water_img" data-url="/ajax/upload"><?php echo __('上传图片'); ?></button>
                                    </div>

                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo __('水印位置'); ?></label>
                                        <div class="layui-input-inline">
                                            <table class="uplpad-pos" width="300" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                    <tr>
                                                        <td><input type="radio" name="upload_water_pos" value="1" <?php if($config['upload_water_pos'] == '1'): ?> checked=""
                                                            <?php endif; ?> ><?php echo __('顶部居左'); ?></td>
                                                        <td><input type="radio" name="upload_water_pos" value="2" <?php if($config['upload_water_pos'] == '2'): ?> checked=""
                                                            <?php endif; ?> ><?php echo __('顶部居中'); ?></td>
                                                        <td><input type="radio" name="upload_water_pos" value="3" <?php if($config['upload_water_pos'] == '3'): ?> checked=""
                                                            <?php endif; ?> ><?php echo __('顶部居右'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="radio" name="upload_water_pos" value="4" <?php if($config['upload_water_pos'] == '4'): ?> checked=""
                                                            <?php endif; ?> ><?php echo __('左边居中'); ?></td>
                                                        <td><input type="radio" name="upload_water_pos" value="5" <?php if($config['upload_water_pos'] == '5'): ?> checked=""
                                                            <?php endif; ?> ><?php echo __('图片中心'); ?></td>
                                                        <td><input type="radio" name="upload_water_pos" value="6" <?php if($config['upload_water_pos'] == '6'): ?> checked=""
                                                            <?php endif; ?> ><?php echo __('右边居中'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="radio" name="upload_water_pos" value="7" <?php if($config['upload_water_pos'] == '7'): ?> checked=""
                                                            <?php endif; ?> ><?php echo __('底部居左'); ?></td>
                                                        <td><input type="radio" name="upload_water_pos" value="8" <?php if($config['upload_water_pos'] == '8'): ?> checked=""
                                                            <?php endif; ?> ><?php echo __('底部居中'); ?></td>
                                                        <td><input type="radio" name="upload_water_pos" value="9" <?php if($config['upload_water_pos'] == '9'): ?> checked=""
                                                            <?php endif; ?> ><?php echo __('底部居右'); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- // 视频配置开始 -->
                            <div class="layui-tab-item">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">播放器：</label>
                                    <div class="layui-input-inline" style="width: 145px;">
                                        <input type="text" name="play[play_width]" placeholder="播放器宽度"
                                            value="<?php echo htmlentities($config['play']['play_width']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-input-inline" style="width: 145px;">
                                        <input type="text" name="play[play_height]" placeholder="播放器高度"
                                            value="<?php echo htmlentities($config['play']['play_height']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* 播放器的高度和宽度设置 </div>
                                </div>


                                <div class="layui-form-item ">
                                    <label class="layui-form-label">开启列表：</label>
                                    <div class="layui-input-inline">
                                        <select name="play[play_show]">
                                            <option value="1">开启</option>
                                            <option value="0" selected="">关闭</option>
                                        </select>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* 附件的保存路径和风格。</div>
                                </div>

                                <div class="layui-form-item ">
                                    <label class="layui-form-label">广告时长：</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="play[play_second]" autocomplete="off"
                                            value="<?php echo htmlentities($config['play']['play_second']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* 设置为0则不启用。</div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label">地区列表:</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="play[play_area]" autocomplete="off"
                                            value="<?php echo htmlentities($config['play']['play_area']); ?>" class="layui-input">
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label">年代列表:</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="play[play_year]" autocomplete="off"
                                            value="<?php echo htmlentities($config['play']['play_year']); ?>" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">视频版本:</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="play[play_version]" autocomplete="off"
                                            value="<?php echo htmlentities($config['play']['play_version']); ?>" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">视频对白:</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="play[play_language]" autocomplete="off"
                                            value="<?php echo htmlentities($config['play']['play_language']); ?>" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">播出周期:</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="play[play_week]" autocomplete="off"
                                            value="<?php echo htmlentities($config['play']['play_week']); ?>" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">缓冲广告:</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="play[play_playad]" autocomplete="off"
                                            value="<?php echo htmlentities($config['play']['play_playad']); ?>" class="layui-input">
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label">下载地址:</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="play[play_down]" autocomplete="off"
                                            value="<?php echo htmlentities($config['play']['play_down']); ?>" class="layui-input">
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label">服务器组:</label>
                                    <div class="layui-input-block">
                                        <textarea name="play[play_downgorup]" class="layui-textarea"
                                            placeholder="* 请写入提供下载的服务器组"><?php echo htmlentities($config['play']['play_downgorup']); ?></textarea>
                                        <div class="layui-form-mid layui-word-aux">* 下载服务器前缀，前缀名称$$$对应地址每行一个</div>
                                    </div>
                                </div>

                            </div>

                            <!-- // 接口配置信息开始 -->
                            <div class="layui-tab-item">

                                <div class="layui-collapse " lay-accordion="" style="border-style: none;">

                                    <div class="layui-colla-item">

                                        <h2 class="layui-colla-title"><i
                                                class="layui-icon layui-icon-email layui-color-blue"></i><?php echo __('SMTP邮件'); ?>
                                        </h2>
                                        <div class="layui-colla-content layui-show">

                                            <div class="layui-form-item">
                                                <label class="layui-form-label"><?php echo __('调试模式'); ?></label>
                                                <div class="layui-input-inline">
                                                    <input type="radio" name="email[smtp_debug]" value="1"
                                                        title="<?php echo __('开启'); ?>" <?php if($config['email']['smtp_debug'] == 1): ?> checked <?php endif; ?>
                                                    >
                                                    <input type="radio" name="email[smtp_debug]" value="0"
                                                        title="<?php echo __('关闭'); ?>" <?php if($config['email']['smtp_debug'] == 0): ?> checked <?php endif; ?>
                                                    >
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">*
                                                    <?php echo __('调试模式请在[浏览器开发者工具]查看错误信息'); ?></div>
                                            </div>

                                            <div class="layui-form-item">
                                                <label class="layui-form-label"><?php echo __('服务器状态'); ?></label>
                                                <div class="layui-input-inline">
                                                    <div class="layui-form-mid layui-word-aux">

                                                        <font color="black">fsockopen</font>
                                                        <i class="layui-icon <?php if(empty($config['fsockopen']) || (($config['fsockopen'] instanceof \think\Collection || $config['fsockopen'] instanceof \think\Paginator ) && $config['fsockopen']->isEmpty())): ?>
                                                            layui-icon-close-fill layui-color-red
                                                            <?php else: ?>
                                                            layui-icon-ok-circle layui-color-green<?php endif; ?> " >
                                                        </i>&emsp;

                                                        <font color="black">stream_socket_client</font>
                                                        <i class="layui-icon <?php if(empty($config['stream_socket_client']) || (($config['stream_socket_client'] instanceof \think\Collection || $config['stream_socket_client'] instanceof \think\Paginator ) && $config['stream_socket_client']->isEmpty())): ?>
                                                            layui-icon-close-fill layui-color-red
                                                            <?php else: ?>
                                                            layui-icon-ok-circle layui-color-green<?php endif; ?> " >
                                                        </i>
                                                    </div>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">*
                                                    <?php echo __('发送邮件依赖的函数，如不可用请开启函数扩展'); ?>！</div>
                                            </div>

                                            <!-- codemirror 编辑器 -->
                                            <div class="layui-form-item ">
                                                <label class="layui-form-label"><?php echo __('信息模板'); ?></label>
                                                <div class="layui-input-inline">
                                                    <div class="layui-form-mid layui-word-aux">
                                                        <a href="javascript:void(0)" class="layui-color-blue"
                                                            lay-open="" data-url="<?php echo url('/tpl/showTpl'); ?>"
                                                            data-title="邮件模板<?php echo __(''); ?>" data-area="500px,260px"
                                                            data-offset="30%">[<?php echo __('点击编辑'); ?>]</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="layui-form-item ">
                                                <label class="layui-form-label"><?php echo __('服务器IP'); ?></label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="email[smtp_host]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['email']['smtp_host']); ?>" class="layui-input smtp_host">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('发送邮箱的smtp地址，如:
                                                    smtp.qq.com或smtp.gmail.com'); ?></div>
                                            </div>

                                            <div class="layui-form-item ">
                                                <label class="layui-form-label"><?php echo __('邮箱端口'); ?></label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="email[smtp_port]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['email']['smtp_port']); ?>" class="layui-input smtp_port">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">
                                                    <font color="red">* <?php echo __('注意：请阅读STMP服务官方文档获取端口，一般发送失败都是端口问题！'); ?>
                                                    </font>
                                                </div>
                                            </div>

                                            <div class="layui-form-item ">
                                                <label class="layui-form-label"><?php echo __('用户名'); ?></label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="email[smtp_name]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['email']['smtp_name']); ?>" class="layui-input smtp_name">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('用于发送邮件显示，默认为管理员'); ?>。
                                                </div>
                                            </div>

                                            <div class="layui-form-item ">
                                                <label class="layui-form-label"><?php echo __('邮箱帐户'); ?></label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="email[smtp_user]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['email']['smtp_user']); ?>" class="layui-input smtp_user">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('用于发送给客户的邮件地址'); ?>。
                                                </div>
                                            </div>

                                            <div class="layui-form-item ">
                                                <label class="layui-form-label"><?php echo __('邮箱密码'); ?></label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="email[smtp_pass]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['email']['smtp_pass']); ?>" class="layui-input smtp_pass">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('邮箱密码或授权码'); ?>。</div>
                                            </div>
                                            <div class="layui-form-item ">
                                                <label class="layui-form-label"><?php echo __('测试邮箱'); ?></label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="email[smtp_test]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['email']['smtp_test']); ?>" class="layui-input smtp_test">
                                                </div>
                                                <button type="button" class="layui-btn layui-btn-normal" lay-ajax=""
                                                    data-url="<?php echo url('/index/testEmail'); ?>"
                                                    data-object="smtp_host:smtp_host,smtp_port:smtp_port,smtp_name:smtp_name,smtp_user:smtp_user,smtp_pass:smtp_pass,smtp_test:smtp_test"><i
                                                        class="layui-icon layui-icon-email"></i>
                                                    <?php echo __('测试发送'); ?></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="layui-colla-item">
                                        <h2 class="layui-colla-title"><i
                                                class="layui-icon layui-icon-user layui-color-blue"></i><?php echo __('社会化登录'); ?>
                                        </h2>
                                        <div class="layui-colla-content">
                                            <!-- // 社会化登录开始 -->
                                            <div class="layui-card-header" style="margin-bottom:20px;"><i
                                                    class="layui-icon" style="margin-right: 3px">
                                                    <img src="/static/images/interface/qq.png" width="18" height="16"
                                                        alt="QQ登录">
                                                </i><?php echo __('QQ登录'); ?></div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">APP_ID</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="qq[app_id]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['qq']['app_id']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('connect.qq.com
                                                    申请的appid'); ?></div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">APP_KEY</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="qq[app_key]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['qq']['app_key']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('connect.qq.com
                                                    申请的appkey'); ?></div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label"><?php echo __('callback地址'); ?></label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="qq[callback]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['qq']['callback']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('申请QQ互联登录填写的回调地址'); ?>
                                                </div>
                                            </div>
                                            <!-- // 微信登录配置 -->
                                            <div class="layui-card-header" style="margin-bottom:20px;"><i
                                                    class="layui-icon">
                                                    <img src="/static/images/interface/wechat.png" width="16"
                                                        height="16" alt="<?php echo __('微信登录'); ?>">
                                                </i><?php echo __('微信登录'); ?></div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">APP_ID</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="weixin[app_id]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['weixin']['app_id']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('open.weixin.qq.com
                                                    申请的appid'); ?></div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">APP_KEY</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="weixin[app_key]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['weixin']['app_key']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('open.weixin.qq.com
                                                    申请的appkey'); ?></div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label"><?php echo __('callback地址'); ?></label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="weixin[callback]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['weixin']['callback']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('申请微信扫码登录填写的回调地址'); ?>
                                                </div>
                                            </div>
                                            <!-- // Gitee配置 -->
                                            <div class="layui-card-header" style="margin-bottom:20px;"><i
                                                    class="layui-icon">
                                                    <img src="/static/images/interface/gitee.jpg" width="16" height="16"
                                                        alt="<?php echo __('微博登录'); ?>">
                                                </i><?php echo __('Gitee码云'); ?></div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">APP_ID</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="gitee[app_id]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['gitee']['app_id']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('我的应用/应用详情 申请的Client
                                                    ID'); ?></div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">APP_KEY</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="gitee[app_key]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['gitee']['app_key']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('我的应用/应用详情 申请的Client
                                                    Secret'); ?></div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label"><?php echo __('callback地址'); ?></label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="gitee[callback]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['gitee']['callback']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('申请Gitee码云登录填写的回调地址'); ?>
                                                </div>
                                            </div>

                                            <!-- // 新浪微博登录 -->
                                            <div class="layui-card-header" style="margin-bottom:20px;"><i
                                                    class="layui-icon">
                                                    <img src="/static/images/interface/sina.png" width="16" height="16"
                                                        alt="<?php echo __('微博登录'); ?>">
                                                </i><?php echo __('微博登录'); ?></div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">APP_ID</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="weibo[app_id]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['weibo']['app_id']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('open.weibo.com
                                                    申请的appid'); ?></div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">APP_KEY</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="weibo[app_key]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['weibo']['app_key']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('open.weibo.com
                                                    申请的appkey'); ?></div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label"><?php echo __('callback地址'); ?></label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="weibo[callback]" autocomplete="off"
                                                        value="<?php echo htmlentities($config['weibo']['callback']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('申请新浪微博登录填写的回调地址'); ?>
                                                </div>
                                            </div>
                                            <!-- // 社会化登录结束 -->
                                        </div>
                                    </div>

                                    <div class="layui-colla-item">
                                        <h2 class="layui-colla-title"><i
                                                class="layui-icon layui-icon-rmb layui-color-blue"></i><?php echo __('云支付接口'); ?>
                                        </h2>
                                        <div class="layui-colla-content">
                                            <!-- // 支付宝支付开始 -->
                                            <div class="layui-card-header" style="margin-bottom:20px;"><i
                                                    class="layui-icon">
                                                    <img src="/static/images/interface/alipay.png" width="16"
                                                        height="16" alt="支付宝支付">
                                                </i><?php echo __('支付宝'); ?></div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">支付模式</label>
                                                <div class="layui-input-inline">
                                                    <input type="radio" name="alipay[mode]" value="0" title="正式环境" <?php if($config['alipay']['mode'] ==  0): ?> checked
                                                    <?php endif; ?> >
                                                    <input type="radio" name="alipay[mode]" value="1" title="沙箱模式" <?php if($config['alipay']['mode'] == 1): ?> checked
                                                    <?php endif; ?> >
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">
                                                    <font color="red">*</font> 沙箱环境下，请使用沙箱版支付宝调试
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">app_id</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="alipay[app_id]"
                                                        value="<?php echo htmlentities($config['alipay']['app_id']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('支付宝应用appid'); ?></div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">app_public_cert_path</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="alipay[app_public_cert_path]"
                                                        value="<?php echo htmlentities($config['alipay']['app_public_cert_path']); ?>"
                                                        class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">
                                                    <font color="red">*</font> <?php echo __('支付宝RSA2_PKCS1公钥'); ?>
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">app_secret_cert</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="alipay[app_secret_cert]"
                                                        value="<?php echo htmlentities($config['alipay']['app_secret_cert']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">
                                                    <font color="red">*</font> <?php echo __('应用RSA2_PKCS1私钥'); ?>
                                                </div>
                                            </div>

                                            <div class="layui-form-item">
                                                <label class="layui-form-label">return_url</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="alipay[return_url]"
                                                        value="<?php echo htmlentities($config['alipay']['return_url']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('支付成功同步回调地址'); ?></div>
                                            </div>

                                            <div class="layui-form-item">
                                                <label class="layui-form-label">notify_url</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="alipay[notify_url]"
                                                        value="<?php echo htmlentities($config['alipay']['notify_url']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">
                                                    <font color="red">*</font> <?php echo __('支付成功异步服务器通知地址,业务逻辑'); ?>
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">alipay_public_cert_path</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="alipay[alipay_public_cert_path]"
                                                        value="<?php echo htmlentities($config['alipay']['alipay_public_cert_path']); ?>"
                                                        class="layui-input cert_client">
                                                </div>
                                                <button type="button" class="layui-btn layui-btn-normal"
                                                    lay-upload="cert_client"><?php echo __('上传支付宝公钥证书'); ?></button>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">alipay_root_cert_path</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="alipay[alipay_root_cert_path]"
                                                        value="<?php echo htmlentities($config['alipay']['alipay_root_cert_path']); ?>"
                                                        class="layui-input cert_key">
                                                </div>
                                                <button type="button" class="layui-btn layui-btn-normal"
                                                    lay-upload="cert_key"><?php echo __('上传支付宝根证书'); ?></button>
                                            </div>

                                            <!-- // 微信支付开始 -->
                                            <div class="layui-card-header" style="margin-bottom:20px;"><i
                                                    class="layui-icon">
                                                    <img src="/static/images/interface/wechat.png" width="16"
                                                        height="16" alt="">
                                                </i><?php echo __('微信支付'); ?></div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">支付模式</label>
                                                <div class="layui-input-inline">
                                                    <input type="radio" name="wechat[mode]" value="0" title="正式环境" <?php if($config['wechat']['mode'] == 0): ?> checked
                                                    <?php endif; ?> >
                                                    <input type="radio" name="wechat[mode]" value="1" title="仿真环境" <?php if($config['wechat']['mode'] == 1): ?> checked
                                                    <?php endif; ?> >
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* 仿真环境下，请使用sandboxnew地址访问
                                                </div>
                                            </div>

                                            <div class="layui-form-item">
                                                <label class="layui-form-label">商户ID</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="wechat[mch_id]" placeholder="<?php echo __('必填'); ?>"
                                                        value="<?php echo htmlentities($config['wechat']['mch_id']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">
                                                    <font color="red">*</font> <?php echo __('微信支付绑定商户号的MCH_ID'); ?>
                                                </div>
                                            </div>

                                            <div class="layui-form-item">
                                                <label class="layui-form-label">商户私钥</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="wechat[mch_secret_key]"
                                                        placeholder="<?php echo __('必填'); ?>"
                                                        value="<?php echo htmlentities($config['wechat']['mch_secret_key']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('微信商户平台V3版秘钥'); ?></div>
                                            </div>

                                            <div class="layui-form-item">
                                                <label class="layui-form-label">公众号ID</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="wechat[mp_app_id]"
                                                        placeholder="<?php echo __('选填'); ?>" value="<?php echo htmlentities($config['wechat']['mp_app_id']); ?>"
                                                        class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('微信公众号ID'); ?></div>
                                            </div>

                                            <div class="layui-form-item">
                                                <label class="layui-form-label">小程序ID</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="wechat[mini_app_id]"
                                                        placeholder="<?php echo __('选填'); ?>" value="<?php echo htmlentities($config['wechat']['mini_app_id']); ?>"
                                                        class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('微信小程序ID'); ?></div>
                                            </div>

                                            <div class="layui-form-item">
                                                <label class="layui-form-label">回调地址</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="wechat[notify_url]"
                                                        placeholder="<?php echo __('必填'); ?>" value="<?php echo htmlentities($config['wechat']['notify_url']); ?>"
                                                        class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">
                                                    <font color="red">*</font> <?php echo __('微信支付成功回调地址'); ?>
                                                </div>
                                            </div>

                                            <div class="layui-form-item">
                                                <label class="layui-form-label">商户私钥证书</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="wechat[mch_secret_cert]"
                                                        value="<?php echo htmlentities($config['wechat']['mch_secret_cert']); ?>"
                                                        class="layui-input wxcert_client">
                                                </div>
                                                <button type="button" class="layui-btn layui-btn-normal"
                                                    lay-upload="wxcert_client"><?php echo __('上传V3私钥证书'); ?></button>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">商户公钥证书</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="wechat[mch_public_cert_path]"
                                                        value="<?php echo htmlentities($config['wechat']['mch_public_cert_path']); ?>"
                                                        class="layui-input wxcert_key">
                                                </div>
                                                <button type="button" class="layui-btn layui-btn-normal"
                                                    lay-upload="wxcert_key"><?php echo __('上传V3公钥证书'); ?></button>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="layui-colla-item">
                                        <h2 class="layui-colla-title"><i
                                                class="layui-icon layui-icon-cellphone layui-color-blue"></i><?php echo __('短信SMS接口'); ?>
                                        </h2>
                                        <div class="layui-colla-content">

                                            <div class="layui-card-header" style="margin-bottom:20px;"><i
                                                    class="layui-icon">
                                                    <img src="/static/images/interface/aliyun.png?12x" width="16"
                                                        height="16" alt="">
                                                </i><?php echo __('阿里SMS短信'); ?></div>

                                            <div class="layui-form-item">
                                                <label class="layui-form-label"><?php echo __('短信服务商'); ?></label>
                                                <div class="layui-input-inline">
                                                    <select name="smstype">
                                                        <option value="alisms" <?php if($config['smstype'] == 'alisms'): ?> selected="" <?php endif; ?> ><?php echo __('阿里云短信'); ?></option>
                                                        <option value="tensms" <?php if($config['smstype'] == 'tensms'): ?> selected="" <?php endif; ?> ><?php echo __('腾讯云短信'); ?></option>
                                                    </select>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <font color="red">
                                                        <?php echo __('请选择短信服务商类型'); ?>！。</font>
                                                </div>
                                            </div>

                                            <div class="layui-form-item">
                                                <label class="layui-form-label">APP_ID</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="alisms[app_id]"
                                                        value="<?php echo htmlentities($config['alisms']['app_id']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('阿里云SMS服务器的Region
                                                    Id'); ?>。 </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">APP_SIGN</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="alisms[app_sign]"
                                                        value="<?php echo htmlentities($config['alisms']['app_sign']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('使用SMS服务所需的公司短信签名'); ?>。
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">ACCESS_ID</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="alisms[access_id]"
                                                        value="<?php echo htmlentities($config['alisms']['access_id']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('访问阿里云API的密钥的AccessKey
                                                    ID'); ?>。</div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">ACCESS_SECRET</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="alisms[access_secret]"
                                                        value="<?php echo htmlentities($config['alisms']['access_secret']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('访问阿里云API的密钥的AccessKey
                                                    Secret'); ?>。</div>
                                            </div>

                                            <div class="layui-card-header" style="margin-bottom:20px;"><i
                                                    class="layui-icon">
                                                    <img src="/static/images/interface/qcloud.png" width="16"
                                                        height="16" alt="">
                                                </i><?php echo __('腾讯SMS短信'); ?></div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">APP_ID</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="tensms[app_id]"
                                                        value="<?php echo htmlentities($config['tensms']['app_id']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('腾讯SMS服务应用列表中应用的SDK
                                                    AppID'); ?>。</div>
                                            </div>

                                            <div class="layui-form-item">
                                                <label class="layui-form-label">APP_SIGN</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="tensms[app_sign]"
                                                        value="<?php echo htmlentities($config['tensms']['app_sign']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">*
                                                    <?php echo __('在腾讯SMS服务国内短信中可以看到该签名'); ?>。</div>
                                            </div>

                                            <div class="layui-form-item">
                                                <label class="layui-form-label">SECRET_ID</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="tensms[secret_id]"
                                                        value="<?php echo htmlentities($config['tensms']['secret_id']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">*
                                                    <?php echo __('您在腾讯云中API密钥的SecretId'); ?>。</div>
                                            </div>

                                            <div class="layui-form-item">
                                                <label class="layui-form-label">SECRET_KEY</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="tensms[secret_key]"
                                                        value="<?php echo htmlentities($config['tensms']['secret_key']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">
                                                    <font color="red">* <?php echo __('您在腾讯云中API密钥的SecretKey，建议创建子密钥使用'); ?>。</font>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="layui-colla-item">
                                        <h2 class="layui-colla-title"><i
                                                class="layui-icon layui-icon-dialogue layui-color-blue"></i><?php echo __('微信公众号接口'); ?>
                                        </h2>
                                        <div class="layui-colla-content">
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">APP_ID</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="mpwechat[app_id]"
                                                           value="<?php echo htmlentities($config['mpwechat']['app_id']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">*
                                                    <?php echo __('开发者ID是公众号开发识别码，配合开发者密码可调用公众号的接口能力'); ?>。</div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">APP_SECRET</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="mpwechat[secret]"
                                                           value="<?php echo htmlentities($config['mpwechat']['secret']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">
                                                    <font color="red">* <?php echo __('开发者密码是校验公众号开发者身份的密码，具有极高的安全性。'); ?>。</font>
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">APP_TOKEN</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="mpwechat[token]"
                                                           value="<?php echo htmlentities($config['mpwechat']['token']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">* <?php echo __('微信公众平台令牌(Token)'); ?>。
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">ENCODING_KEY</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="mpwechat[aes_key]"
                                                           value="<?php echo htmlentities($config['mpwechat']['aes_key']); ?>" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">
                                                    <font color="red">* <?php echo __('消息加解密密钥将用于消息体加解密'); ?>。</font>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- // 用户注册配置 -->
                            <div class="layui-tab-item">

                                <div class="layui-card-header" style="margin-bottom: 20px;"><?php echo __('用户注册'); ?></div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('注册开关'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="radio" name="user_status" value="1" title="<?php echo __('开启'); ?>" <?php if($config['user_status'] == 1): ?> checked <?php endif; ?> >
                                        <input type="radio" name="user_status" value="0" title="<?php echo __('关闭'); ?>" <?php if($config['user_status'] == 0): ?> checked <?php endif; ?> >
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('默认开启，如不需要可关闭'); ?>。</div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('注册方式'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="radio" name="user_register_style" value="normal"
                                            title="<?php echo __('普通'); ?>" <?php if($config['user_register_style']  == 'normal'): ?> checked
                                        <?php endif; ?> >
                                        <input type="radio" name="user_register_style" value="mobile"
                                            title="<?php echo __('手机'); ?>" <?php if($config['user_register_style'] == 'mobile'): ?> checked
                                        <?php endif; ?> >
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">
                                        <font color="red">* <?php echo __('邀请码注册默认状态为已审核'); ?>！</font>
                                    </div>
                                </div>

                                <div class="layui-form-item ">
                                    <label class="layui-form-label"><?php echo __('允许用户投稿'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="radio" name="user_document" value="1" title="<?php echo __('开启'); ?>" <?php if($config['user_document'] == 1): ?> checked <?php endif; ?> >
                                        <input type="radio" name="user_document" value="0" title="<?php echo __('关闭'); ?>" <?php if($config['user_document'] == 0): ?> checked <?php endif; ?> >
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('是否支持用户投稿到栏目'); ?>。</div>
                                </div>

                                <div class="layui-form-item ">
                                    <label class="layui-form-label"><?php echo __('开启违禁词检测'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="radio" name="user_sensitive" value="1" title="<?php echo __('开启'); ?>" <?php if($config['user_sensitive'] == 1): ?> checked <?php endif; ?> >
                                        <input type="radio" name="user_sensitive" value="0" title="<?php echo __('关闭'); ?>" <?php if($config['user_sensitive'] == 0): ?> checked <?php endif; ?> >
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('用户投稿违禁词检测，默认开启'); ?>。</div>
                                </div>
                                <div class="layui-form-item ">
                                    <label class="layui-form-label"><?php echo __('投稿获得积分'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="user_document_integra" autocomplete="off"
                                            value="<?php echo htmlentities($config['user_document_integra']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('用户投稿获得的初始积分'); ?></div>
                                </div>

<!--                                <div class="layui-form-item ">-->
<!--                                    <label class="layui-form-label"><?php echo __('激活码有效期'); ?></label>-->
<!--                                    <div class="layui-input-inline">-->
<!--                                        <input type="text" name="user_valitim" autocomplete="off"-->
<!--                                            value="<?php echo htmlentities($config['user_valitime']); ?>" class="layui-input">-->
<!--                                    </div>-->
<!--                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('用户激活码的有效期，默认10分钟'); ?>。</div>-->
<!--                                </div>-->

                                <div class="layui-form-item ">
                                    <label class="layui-form-label"><?php echo __('每日注册'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="user_register_second" autocomplete="off"
                                            value="<?php echo htmlentities($config['user_register_second']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('每日用户单IP注册最大数量'); ?></div>
                                </div>


                                <div class="layui-form-item ">
                                    <label class="layui-form-label"><?php echo __('登录获得积分'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="user_login_integra" autocomplete="off"
                                            value="<?php echo htmlentities($config['user_login_integra']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('用户每日登录获得积分'); ?>。</div>
                                </div>

                                <div class="layui-form-item ">
                                    <label class="layui-form-label"><?php echo __('推广获得积分'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="user_spread_integra" autocomplete="off"
                                            value="<?php echo htmlentities($config['user_spread_integra']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('用户推广会员获得积分'); ?></div>
                                </div>

                                <div class="layui-form-item ">
                                    <label class="layui-form-label"><?php echo __('用户搜索间隔'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="user_search_interval" autocomplete="off"
                                            value="<?php echo htmlentities($config['user_search_interval']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('用户搜索，查询数据间隔，单位 / 秒'); ?></div>
                                </div>


                                <div class="layui-form-item ">
                                    <label class="layui-form-label"><?php echo __('禁止注册'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="user_reg_notallow" autocomplete="off"
                                            value="<?php echo htmlentities($config['user_reg_notallow']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('禁止注册的用户名！'); ?></div>
                                </div>

                                <div class="layui-card-header" style="margin-bottom: 20px;"><?php echo __('评论留言设置'); ?></div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('评论开关'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="radio" name="user_form_status" value="1" title="<?php echo __('开启'); ?>" <?php if($config['user_form_status'] == 1): ?> checked <?php endif; ?> >
                                        <input type="radio" name="user_form_status" value="0" title="<?php echo __('关闭'); ?>" <?php if($config['user_form_status'] == 0): ?> checked <?php endif; ?> >
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('默认开启，如不需要可关闭'); ?>！。</div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('评论审核'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="radio" name="user_form_check" value="1" title="<?php echo __('开启'); ?>" <?php if($config['user_form_check'] == 1): ?> checked <?php endif; ?> >
                                        <input type="radio" name="user_form_check" value="0" title="<?php echo __('关闭'); ?>" <?php if($config['user_form_check'] == 0): ?> checked <?php endif; ?> >
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('开启后需要审核评论才会展示'); ?>。</div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('游客评论'); ?></label>

                                    <div class="layui-input-inline">
                                        <input type="radio" name="user_isLogin" value="1" title="<?php echo __('开启'); ?>" <?php if($config['user_isLogin'] == 1): ?> checked <?php endif; ?> >
                                        <input type="radio" name="user_isLogin" value="0" title="<?php echo __('关闭'); ?>" <?php if($config['user_isLogin'] == 0): ?> checked <?php endif; ?> >
                                    </div>

                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('开启后需要审核评论才会展示'); ?>！</div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo __('匿名评论'); ?></label>

                                    <div class="layui-input-inline">
                                        <input type="radio" name="user_anonymous" value="1" title="<?php echo __('开启'); ?>" <?php if($config['user_anonymous'] == 1): ?> checked <?php endif; ?> >
                                        <input type="radio" name="user_anonymous" value="0" title="<?php echo __('关闭'); ?>" <?php if($config['user_anonymous'] == 0): ?> checked <?php endif; ?> >
                                    </div>

                                    <div class="layui-form-mid layui-word-aux">
                                        <font color="red">* <?php echo __('用户登录后是否可以匿名发表评论'); ?>！</font>
                                    </div>
                                </div>

                                <div class="layui-form-item ">
                                    <label class="layui-form-label"><?php echo __('评论间隔'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="user_form_second" autocomplete="off"
                                            value="<?php echo htmlentities($config['user_form_second']); ?>" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">* <?php echo __('用户评论间隔秒数'); ?>。</div>
                                </div>
                                <div class="layui-form-item ">
                                    <label class="layui-form-label"><?php echo __('脏话过滤'); ?></label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="user_replace" autocomplete="off"
                                            value="<?php echo htmlentities($config['user_replace']); ?>" class="layui-input">
                                    </div>
                                </div>

                            </div>

                            <!-- // 自定义变量开始 -->
                            <div class="layui-tab-item">

                                <div class="layui-card">

                                    <table class="layui-table" lay-skin="nob">
                                        <colgroup>
                                            <col width="100">
                                            <col width="200">
                                            <col width="100">
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th>变量名</th>
                                                <th>变量值</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody id="layui-variable-content">

                                            <?php if(is_array($config['variable']) || $config['variable'] instanceof \think\Collection || $config['variable'] instanceof \think\Paginator): $i = 0; $__LIST__ = $config['variable'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                <tr>
                                                    <td><input type="text" value="<?php echo htmlentities($key); ?>"
                                                            class="layui-input layui-variable-key"
                                                            lay-verify="required"></td>
                                                    <td><input type="text" name="variable[<?php echo htmlentities($key); ?>]" value="<?php echo htmlentities($vo); ?>"
                                                            class="layui-input layui-variable-value"></td>
                                                    <td><button type="button"
                                                            class="layui-btn layui-btn-primary layui-btn-sm"><i
                                                                class="layui-icon layui-icon-delete"></i></button></td>
                                                </tr>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>

                                        </tbody>
                                    </table>

                                </div>
                                <button type="button"
                                    class="layui-btn layui-btn-normal layui-variable-add"><?php echo __('增加变量'); ?></button>
                            </div>

                            <!-- // POST按钮 -->
                            <div class="layui-form-item layui-layout-admin" style="display: block;">
                                <div class="layui-input-block">
                                    <div class="layui-footer" id="layui-footer-btn">
                                        <button class="layui-btn layui-btn-normal" lay-submit=""
                                            lay-filter="submitIframe" type="button"><?php echo __('立即提交'); ?></button>
                                        <button type="reset" class="layui-btn layui-btn-primary"><?php echo __('重置'); ?></button>
                                    </div>
                                </div>
                            </div>
                            <!-- // POST按钮结束 -->
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>


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
    layui.use(['form', 'jquery', 'layedit', 'admin'], function () {

        var form = layui.form;
        var admin = layui.admin;
        var jquery = layui.jquery;
        // 渲染富文本编辑器
        var layedit = layui.layedit;
        var layindex = layedit.build('site_notice', { height: 110, color: '#ffffff' });

        // 异步验证表单
        form.verify({
            siteClose: function (value) {
                return layedit.sync(layindex);
            }
        });

        // 增加变量
        jquery('.layui-variable-add').on('click', function () {
            var html = '<tr>';
            html += '<td><input type="text" class="layui-input layui-variable-key"  lay-verify="required" ><\/td>';
            html += '<td><input type="text" class="layui-input layui-variable-value"><\/td>';
            html += '<td><button type="button" class="layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon layui-icon-delete"><\/i><\/button><\/td>';
            html += '<\/tr>';
            jquery('#layui-variable-content').append(html);
        })

        // 改变表单值
        jquery('body').on('change', '.layui-variable-key', function () {
            var that = jquery(this),
                name = 'variable[' + that.val() + ']';
            jquery(that).parents('tr').find('.layui-variable-value').attr('name', name);
        })

        // 删除自定义变量
        jquery('body').on('click', '#layui-variable-content .layui-btn', function () {
            jquery(this).parents('tr').remove();
        })
    });
</script>
</body>

</html>
