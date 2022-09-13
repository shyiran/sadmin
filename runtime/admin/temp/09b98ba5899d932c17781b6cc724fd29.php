<?php /*a:3:{s:51:"D:\SwiftAdmin\app\admin\view\system\user\index.html";i:1659669829;s:47:"D:\SwiftAdmin\app\admin\view\public\header.html";i:1659669829;s:47:"D:\SwiftAdmin\app\admin\view\public\footer.html";i:1659669829;}*/ ?>
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
<div class="layui-fluid">
    <div class="layui-card">
        <!-- // 默认操作按钮 -->
        <div class="layui-card-header layadmin-card-header-auto ">
        <div class="layui-form">
            <div class="layui-form-item">

            <div class="layui-inline">
                <div class="layui-input-inline">
                    <select name="group_id">
                        <option value=""><?php echo __('按用户组查询'); ?></option>
                        <?php if(is_array($userGroup) || $userGroup instanceof \think\Collection || $userGroup instanceof \think\Paginator): $i = 0; $__LIST__ = $userGroup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo htmlentities($vo['id']); ?>" ><?php echo htmlentities($vo['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div> 

            <div class="layui-inline">
                <div class="layui-input-inline">
                    <select name="status">
                        <option value=""><?php echo __('按状态查询'); ?></option>
                        <option value="2" ><?php echo __('已审核'); ?></option>                                 
                        <option value="1" ><?php echo __('未审核'); ?></option>                             
                    </select>
                </div>  
            </div>

            <div class="layui-inline"><div class="layui-input-inline ">
                <input name="nickname" class="layui-input" type="text" placeholder="<?php echo __('关键字搜索'); ?>"/></div>
            </div>

            <div class="layui-inline" >
                <!-- // 默认搜索 -->
                <button class="layui-btn icon-btn" lay-filter="formSearch" lay-submit><i class="layui-icon layui-icon-search"></i><?php echo __('搜索'); ?></button>
                <!-- // 打开添加页面 -->
                <button class="layui-btn icon-btn" lay-open="" data-title="<?php echo __('添加'); ?><?php echo __('会员'); ?>" data-area="500px" data-url="#editforms" >
                    <i class="layui-icon layui-icon-add-1"></i><?php echo __('添加'); ?>
                </button>
            </div>
            </div>
        </div>   
        </div>

        <!-- // 创建数据实例 -->
        <table id="lay-tableList" lay-filter="lay-tableList"></table>        
    </div>
</div>

<!-- // 添加编辑数据 -->
<script type="text/html" id="editforms" >
<div class="layui-fluid layui-bg-white" >
    <form class="layui-form layui-form-fixed" lay-filter="editforms" >
    <input type="text" name="id" hidden="">

    <div class="layui-form-item">
        <label class="layui-form-label"><?php echo __('昵称'); ?></label>
        <div class="layui-input-block">
            <input name="nickname" placeholder="<?php echo __('请输入昵称'); ?>" type="text" class="layui-input"  lay-verify="required" />
        </div>
    </div>                
    <div class="layui-form-item">
        <label class="layui-form-label"><?php echo __('密码'); ?></label>
        <div class="layui-input-block">
            <input name="pwd" placeholder="<?php echo __('请输入密码'); ?>" type="password" class="layui-input"   />
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><?php echo __('邮箱'); ?></label>
        <div class="layui-input-block">
            <input name="email" placeholder="<?php echo __('请输入邮箱'); ?>" type="text" class="layui-input"  lay-verify="required" />
        </div>
    </div>                
    <div class="layui-form-item">
        <label class="layui-form-label"><?php echo __('状态'); ?></label>
        <div class="layui-input-block">
            <input name="status" type="radio" value="1" title="<?php echo __('正常'); ?>" checked/>
            <input name="status" type="radio" value="0" title="<?php echo __('关闭'); ?>"/>
        </div>
    </div>  
    <div class="layui-form-item">
        <label class="layui-form-label"><?php echo __('组别'); ?></label>
        <div class="layui-input-block">
            <select name="group_id" lay-search>
                <option value=""><?php echo __('请选择组别'); ?></option>
                <?php if(is_array($userGroup) || $userGroup instanceof \think\Collection || $userGroup instanceof \think\Paginator): $i = 0; $__LIST__ = $userGroup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                     <option value="<?php echo htmlentities($vo['id']); ?>" ><?php echo htmlentities($vo['title']); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-footer layui-form-item layui-center "  >
        <button class="layui-btn layui-btn-primary" type="button" sa-event="closePageDialog" ><?php echo __('取消'); ?></button>
        <button class="layui-btn" lay-add="<?php echo url('/system.user/add'); ?>" lay-edit="<?php echo url('/system.user/edit'); ?>" lay-filter="submitPage"  lay-submit><?php echo __('提交'); ?></button>
    </div>
    </form>
</div>
</script>

<!-- // 列表状态栏 -->
<script type="text/html" id="columnStatus">
    <input type="checkbox" lay-filter="switchStatus" data-url="<?php echo url('/system.user/status'); ?>" value="{{d.id}}" lay-skin="switch"
     {{d.status==1?'checked':''}}  />
</script>

<!-- // 列表工具栏 -->
<script type="text/html" id="tableBar"> 
    <a class="layui-table-text" data-title="<?php echo __('编辑会员'); ?>" data-area="500px" data-url="#editforms" lay-event="edit"><?php echo __('编辑'); ?></a>
    <div class="layui-divider layui-divider-vertical"></div>
    <a class="layui-table-text" data-url="<?php echo url('/system.user/del'); ?>?id={{d.id}}" lay-event="del"><?php echo __('删除'); ?></a>
</script>

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
    layui.use(['table'], function () {

        var table = layui.table;
        /*
         * 初始化表格
        */
        var isTable = table.render({
            elem: "#lay-tableList"
            ,url: "<?php echo url('/system.user/index'); ?>"
            ,page: true
            ,limit: 18
            ,cols: [[
                {type: 'checkbox', width:50},
                {field: 'id', align: 'center',sort: true,width: 80,  title: 'ID'},
                {field: 'nickname', align: 'left', title: '<?php echo __("昵称"); ?>'},
                {field: 'avatar', align: 'center',width:80,templet:function(d) {
                    return d.avatar ? '<div><img src="'+d.avatar+'" width="32" height="32" lay-image-hover="" lay-size="100,100" ></div>':'<div></div>';
                },title: '头像'},                
                {field: 'group', align: 'center',width:120,title: '用户组'},
                {field: 'email', align: 'center',width:180,title: '<?php echo __("邮箱"); ?>'},
                {field: 'status', align: 'center',width:120,templet:'#columnStatus',title: '<?php echo __("状态"); ?>'},
                {field: 'login_count', align: 'center',width:100,title: '<?php echo __("登录次数"); ?>'},
                {field: 'login_ip', align: 'center',width:160,title: '<?php echo __("登录IP"); ?>'},
                {field: 'region', align: 'center',width:160,title: '<?php echo __("登录地址"); ?>'},
                {field: 'login_time', align: 'center', width:180, title: '<?php echo __("登录时间"); ?>'},
                {align: 'center', toolbar: '#tableBar', width:160, title: '<?php echo __("操作"); ?>'},
            ]]
        })

    })
</script>
