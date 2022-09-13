<?php /*a:3:{s:51:"D:\SwiftAdmin\app\admin\view\system\jobs\index.html";i:1659669829;s:47:"D:\SwiftAdmin\app\admin\view\public\header.html";i:1659669829;s:47:"D:\SwiftAdmin\app\admin\view\public\footer.html";i:1659669829;}*/ ?>
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
                    <input name="title" class="layui-input" type="text" placeholder="<?php echo __('岗位名称'); ?>"/>
                </div>
            </div>
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <input name="alias" class="layui-input" type="text" placeholder="<?php echo __('岗位标识'); ?>"/>
                </div>
            </div>
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <input name="content" class="layui-input" type="text" placeholder="<?php echo __('备注查询'); ?>"/>
                </div>
            </div>
            <div class="layui-inline" >
                <!-- // 默认搜索 -->
                <button class="layui-btn icon-btn" lay-filter="formSearch" lay-submit><i class="layui-icon layui-icon-search"></i><?php echo __('搜索'); ?></button>
                <!-- // 打开添加页面 -->
                <button class="layui-btn icon-btn" lay-open="" data-title="添加岗位<?php echo __(''); ?>" data-area="500px" data-url="#editforms" >
                    <i class="layui-icon layui-icon-add-1"></i><?php echo __('添加'); ?>
                </button>
            </div>
            </div>
        </div>   
        </div>

        <!-- // 创建数据表实例 -->
        <table id="lay-tableList" lay-filter="lay-tableList"></table>        
    </div>
</div>

<!-- // 添加编辑数据 -->
<script type="text/html" id="editforms" >
<div class="layui-fluid layui-bg-white">
    <form class="layui-form layui-form-fixed" lay-filter="editforms" >
    <input type="text" name="id" hidden="">

    <div class="layui-form-item">
        <label class="layui-form-label"><font color="red">* </font><?php echo __('岗位名称'); ?></label>
        <div class="layui-input-block">
            <input name="title" placeholder="<?php echo __('请岗位名称'); ?>" type="text" class="layui-input" lay-verify="required" />
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"><?php echo __('岗位标识'); ?></label>
        <div class="layui-input-block">
            <input name="alias" placeholder="<?php echo __('请岗位标识'); ?>" type="text" class="layui-input"  lay-verify="required" />
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"><?php echo __('排序号'); ?></label>
        <div class="layui-input-block">
            <input name="sort" placeholder="<?php echo __('默认自动生成'); ?>" type="number" class="layui-input"   />
        </div>
    </div>    

    <div class="layui-form-item">
        <label class="layui-form-label"><?php echo __('岗位状态'); ?></label>
        <div class="layui-input-block">
            <input name="status" type="radio" value="1" title="<?php echo __('正常'); ?>" checked/>
            <input name="status" type="radio" value="0" title="<?php echo __('停用'); ?>"/>
        </div>
    </div> 

    <div class="layui-form-item">
        <label class="layui-form-label"><?php echo __('岗位备注'); ?></label>
        <div class="layui-input-block">
            <textarea name="content" id="content" cols="30" rows="10" style="min-height: 110px;" placeholder="<?php echo __('请输入岗位备注'); ?>" class="layui-textarea" 
            lay-verify="required"></textarea>
        </div>
    </div>

    <div class="layui-footer layui-form-item layui-center "  >
        <button class="layui-btn layui-btn-primary" type="button" sa-event="closePageDialog" ><?php echo __('取消'); ?></button>
        <button class="layui-btn" lay-add="<?php echo url('/system.jobs/add'); ?>" lay-edit="<?php echo url('/system.jobs/edit'); ?>" lay-filter="submitPage"  lay-submit><?php echo __('提交'); ?></button>
    </div>
    </form>
</div>
</script>


<!-- // 列表工具栏 -->
<script type="text/html" id="tableBar"> 
    <a class="layui-table-text" data-title="<?php echo __('编辑'); ?>" data-area="500px" data-url="#editforms" lay-event="edit"  ><?php echo __('编辑'); ?></a>
    <div class="layui-divider layui-divider-vertical"></div>
    <a class="layui-table-text" data-url="<?php echo url('/system.jobs/del'); ?>?id={{d.id}}" lay-event="del" ><?php echo __('删除'); ?></a>
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
    layui.use(['table','soulTable'], function () {

        var table = layui.table;
        var soulTable = layui.soulTable;
        /*
         * 初始化表格
        */
        var isTable = table.render({
            elem: "#lay-tableList"
            ,url: "<?php echo url('/system.jobs/index'); ?>"
            ,page: true
            ,cols: [[
                {type: 'checkbox', width:50},
                {field: 'id', align: 'center',sort: true,width: 80,  title: 'ID'},
                {field: 'title', align: 'center', title: "<?php echo __('岗位名称'); ?>"},
                {field: 'alias', align: 'center', title: "<?php echo __('岗位标识'); ?>"},
                {field: 'content', align: 'center',title: "<?php echo __('岗位备注'); ?>"},
                {field: 'create_time', align: 'center',title: "<?php echo __('创建时间'); ?>"},
                {align: 'center', toolbar: '#tableBar',width: 160, title: "<?php echo __('操作'); ?>"},
            ]]
            ,rowDrag: {
                // 表格排序
                done: function(obj) {
                    console.log(obj)
                    // let ids = [];
                    // for (const k in obj.cache) {
                    //     ids.push(obj.cache[k].id)
                    // }
                    // $.post("/central.php/system.archives/sort.html",{
                    //     ids : ids
                    // }, function(res) {
                    //     if (res.code == 200) {
                    //         layer.msg(res.msg);
                    //     } else {
                    //         layer.error(res.msg);
                    //     }
                    // })
                }
            }
            ,done: function(res, curr, count) {
                if (!res.data || res.code === 101) {
                    $('.layui-table-page').remove();
                }

                soulTable.render(this);
            }
        })
    });

</script>
