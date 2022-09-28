<?php /*a:3:{s:52:"D:\SwiftAdmin\app\admin\view\system\admin\rules.html";i:1659669829;s:47:"D:\SwiftAdmin\app\admin\view\public\header.html";i:1664337374;s:47:"D:\SwiftAdmin\app\admin\view\public\footer.html";i:1659669829;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SwiftAdmin 后台管理开发框架</title>
    <link href="/favicon.ico" rel="icon">
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
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

    var _upload_chunkSize = {
    :
    saenv('upload_chunk_size')
    };
</script>
<body>
<!-- // 重定位style -->
<style>
    .layui-form-item .layui-input-inline .layui-form-radio {
        margin-right: 1px;
    }
</style>
<div class="layui-fluid">
    <div class="layui-card">
        <!-- // 默认操作按钮 -->
        <div class="layui-card-header layadmin-card-header-auto ">
            <div class="layui-form">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <div class="layui-form-label"><?php echo __('菜单名称'); ?></div>
                        <div class="layui-input-inline "><input name="title" class="layui-input" type="text" placeholder="<?php echo __('菜单名称'); ?>"/></div>
                    </div>
                    <div class="layui-inline">
                        <div class="layui-form-label"><?php echo __('菜单地址'); ?></div>
                        <div class="layui-input-inline "><input name="router" class="layui-input" type="text" placeholder="<?php echo __('菜单地址'); ?>"/></div>
                    </div>
                    <div class="layui-inline" >
                        <!-- // 默认搜索 -->
                        <button class="layui-btn icon-btn" 
                        lay-filter="treeSearch" lay-submit><i class="layui-icon layui-icon-search"></i><?php echo __('搜索'); ?>
                        </button>
                        <!-- // 打开添加页面 -->
                        <button class="layui-btn icon-btn" lay-open="" data-title="<?php echo __('添加节点'); ?>" callback="add" data-disable="true" data-area="680px" data-url="#editforms" >
                            <i class="layui-icon layui-icon-add-1"></i><?php echo __('添加'); ?>
                        </button>
                        <button class="layui-btn layui-btn-primary icon-btn" id="expandAll" ><i class="layui-icon layui-icon-templeate-1"></i><?php echo __('展开全部'); ?></button>
                        <button class="layui-btn layui-btn-danger icon-btn"  id="foldAll" ><i class="layui-icon layui-icon-add-1"></i><?php echo __('折叠全部'); ?></button>            
                    </div>
                </div>
            </div>   
        </div>
        <!-- // 创建数据表实例 -->
        <table class="layui-hide" id="lay-tableList" lay-filter="lay-tableList"></table>
    </div>

</div>

<!-- // 添加编辑数据 -->
<script type="text/html" id="editforms" >
<div class="layui-fluid layui-bg-white">
    <form class="layui-form" lay-filter="editforms" >
    <input type="text" name="id" hidden="">
    <div class="layui-form-item">
        <label class="layui-form-label"><font color="red">* </font><?php echo __('上级菜单'); ?></label>
        <div class="layui-input-inline">
            <div id="treeNode" name="pid" lay-filter="treeNode" ></div>
        </div>
        <label class="layui-form-label"><font color="red">* </font><?php echo __('权限标识'); ?></label>
        <div class="layui-input-inline">
            <input name="alias" placeholder="<?php echo __('system.target:index'); ?>" type="text" disabled class="layui-input alias layui-disabled"  lay-verify="required"  />
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"><font color="red">* </font><?php echo __('菜单名称'); ?></label>
        <div class="layui-input-inline">
            <input name="title" placeholder="<?php echo __('请输入菜单名称'); ?>" type="text" class="layui-input"  lay-verify="required" />
        </div>
        <label class="layui-form-label"><?php echo __('排序号'); ?></label>
        <div class="layui-input-inline">
            <input name="sort" placeholder="<?php echo __('默认自动生成'); ?>" type="number" class="layui-input"   />
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"><?php echo __('菜单图标'); ?></label>
        <div class="layui-input-inline">
            <input name="icon" placeholder="<?php echo __('请选择菜单图标'); ?>" id="iconPicker" type="text" class="layui-input"  />
        </div>
        <label class="layui-form-label"><?php echo __('菜单类型'); ?></label>
        <div class="layui-input-inline" style="white-space: nowrap;">
            <input name="type" type="radio" value="0" title="<?php echo __('菜单'); ?>" lay-tips="* 菜单默认就是路由地址！" />
            <input name="type" type="radio" value="1" title="<?php echo __('按钮'); ?>" lay-tips="* 按钮不会当作菜单显示！" checked />
            <input name="type" type="radio" value="2" title="<?php echo __('接口'); ?>" lay-tips="* 接口用户上传等API场景！"/>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"><?php echo __('路由地址'); ?></label>
        <div class="layui-input-inline">
            <input name="router" placeholder="<?php echo __('/system.target/index'); ?>" type="text" class="layui-input router"  lay-verify="required" />
        </div>
        <label class="layui-form-label"><font color="red">* </font><?php echo __('是否鉴权'); ?></label>
        <div class="layui-input-inline">
            <input name="auth" type="radio" value="1" title="<?php echo __('开启'); ?>" checked/>
            <input name="auth" type="radio" value="0" title="<?php echo __('关闭'); ?>"/>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label"><font color="red">* </font><?php echo __('正则模式'); ?></label>
        <div class="layui-input-inline" style="width: 500px">
            <input name="condition" placeholder="<?php echo __('请输入正则表达式，如不需要请留空'); ?>！" type="text" class="layui-input"  />
        </div>
    </div>

    <div class="layui-footer layui-form-item layui-center "  >
        <button class="layui-btn layui-btn-primary" type="button" sa-event="closePageDialog" ><?php echo __('取消'); ?></button>
        <button class="layui-btn" lay-add="<?php echo url('/system.adminRules/add'); ?>" lay-edit="<?php echo url('/system.adminRules/edit'); ?>" lay-filter="submitPage"  lay-submit><?php echo __('提交'); ?></button>
    </div>
    </form>
</div>
</script>

<!-- // 列表工具栏 -->
<script type="text/html" id="tableBar"> 
    <!-- 注意，添加的回调函数里面 增加了data-disable="true"属性，也就是不会执行form.val方法 -->
    <a class="layui-table-text" data-title="<?php echo __('添加菜单'); ?>" data-url="#editforms" 
        data-area="668px" callback="add" data-disable="true" lay-event="add" ><?php echo __('添加'); ?></a>
    <div class="layui-divider layui-divider-vertical"></div>
    <a class="layui-table-text" data-title="<?php echo __('编辑菜单'); ?>" data-area="668px" data-url="#editforms" lay-event="edit" callback="edit" ><?php echo __('编辑'); ?></a>
    <div class="layui-divider layui-divider-vertical"></div>
    <a class="layui-table-text" data-url="<?php echo url('/system.adminRules/del'); ?>?id={{d.id}}" lay-event="del" ><?php echo __('删除'); ?></a>
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
    layui.use(['admin','form','treetable','iconPicker'], function () {

        var jquery = layui.jquery;
        var admin = layui.admin;
        var form = layui.form;
        var table = layui.table;
        var treetable = layui.treetable;
        var iconPicker = layui.iconPicker;
        var tableURL = "<?php echo url('/system.adminRules/index'); ?>";

        
        // 渲染初始化表格
        var renderTable = function (tableURL) {
            treetable.render({
                elem: '#lay-tableList',
                treeColIndex: 1,
                treeSpid: 0,
                treeIdName: 'id',
                treePidName: 'pid',
                url: tableURL,
                cellMinWidth: 100,
                treeDefaultClose: true,
                cols: [[
                    {type: 'numbers'},
                    {field: 'title', title: '<?php echo __("菜单名称"); ?>'},
                    {field: 'router', title: '<?php echo __("路由地址"); ?>'},
                    {field: 'alias', title: '<?php echo __("权限标识"); ?>'},
                    {field: 'auth',  width: 80,title: '<?php echo __("鉴权"); ?>',templet: function(d) {
                            var strs = ['<font color="red"><?php echo __("否"); ?></font>', '<span><?php echo __("是"); ?></span>'];
                            return strs[d.auth];                    
                        }, align: 'center'
                    },
                    {
                        field: 'type',title: '<?php echo __("类型"); ?>', width: 80, templet: function (d) {
                            var strs = ['<span class="layui-badge layui-bg-blue"><?php echo __("菜单"); ?></span>', 
                                        '<span class="layui-badge layui-bg-gray"><?php echo __("按钮"); ?></span>',
                                        '<span class="layui-badge layui-bg-cyan"><?php echo __("接口"); ?></span>',
                                        '<span class="layui-badge"><?php echo __("系统"); ?></span>'
                                        ];
                            return strs[d.type];
                        }, align: 'center'
                    },
                    {field: 'sort',  width: 80, align: 'center',title: '<?php echo __("排序"); ?>'},
                    {field: 'create_time', align: 'center',title: '<?php echo __("创建时间"); ?>'},
                    {align: 'center', toolbar: '#tableBar', width: 220,title: '<?php echo __("操作"); ?>'},
                ]]
            });
        }

        // 监听搜索 serialize
        form.on('submit(treeSearch)',function(data) {
        
            var whereURL = '',
                field = data.field;
            for (var key in field ) {
                whereURL += key + '=' + field[key];
                whereURL += '&';
            }

            // 拼接字符串
            whereURL = whereURL.replace(/(.*)&/,'$1 ');
            whereURL = tableURL + '?' + whereURL;
            renderTable(whereURL);
        })

        /*
         * 编辑回调函数示例
         * 这个是默认编辑框的回调函数
         * 默认返回当前点击元素对象、数据合集、配置项
        */
        admin.callback.edit = function(clickthis,colletction,config) {

            // 渲染选择器
            draSelect(colletction.tableThis);

            // 渲染图标
            draIcon();

            // 监听改变
            inputchange();

            // 监听提交
            listenPost(colletction);
        }

        /*
         * 添加的回调函数
        */
        admin.callback.add = function(clickthis,colletction,config) {

            // 渲染选择器
            draSelect(colletction.tableThis);

            // 渲染图标
            draIcon();

            // 监听改变
            inputchange();

            // 监听提交
            listenPost(colletction);          
        }

        // 渲染权限select元素
        var draSelect = function(tableThis, subadd) {

            var checkedId = [];
            if (typeof(tableThis) !== "undefined") {

                if (tableThis.event === 'add') {
                    checkedId.push(tableThis.data.id);
                } else {
                    // 这里需要自己判断pid是否等于0，否则会报错！
                    if (tableThis.data.pid !== 0) {
                        checkedId.push(tableThis.data.pid);
                    }
                }
            }

            var select = xmSelect.render({
                el: '#treeNode',
                tips: '请选择上级菜单',
                name: 'pid',
                height: 'auto',
                data: table.cache['rules'],
                radio: true,
                clickClose: true,
                initValue: checkedId,
                prop: {
                    value: 'id',
                    name:'title'
                },
                tree: {
                    show: true,
                    strict: false,
                    showLine: false,
                    clickExpand: false,
                },
                model: { 
                    icon: 'hidden',
                    label: { 
                        type: 'text' 
                    } 
                },
                theme: {
                    color: '#1890FF'
                }
            })
        }

        // 渲染图标元素
        var draIcon = function() {

            iconPicker.render({
                elem: '#iconPicker',
                type: 'fontClass',
                search: true,
                cellWidth: "19%",
                page: true,
                limit: 12, 
                click: function(data) { // 点击回调
                    jquery('#iconPicker').val(data.icon);
                },
                success: function(d) {  // 渲染成功后的回调
                    //console.log(d);
                }
            });
        }

        // 监听input表单
        var inputchange = function() {
            jquery('.router').bind('input propertychange change',function(data){
                let router = jquery('.router').val();
                let first = router.substr(0, 1);
                if (first !== '/') {
                    jquery('.router').val('/');
                    return layui.layer.error('路由必须以/符号开始');
                }
                router = router.substring(1);
                jquery('.alias').val(router.replace('/',':'));
            })
        }

        // 监听提交
        var listenPost = function(colletction) {

            var tableThis = colletction.tableThis;
            form.on("submit(submitPage)",function(post){

                var pageThat = jquery(this);
                pageThat.attr("disabled",true);
                 // 获取提交地址
                if (typeof(tableThis) !== 'undefined') {
                    _pageUrl = tableThis.event === 'edit' ? pageThat.attr('lay-edit') : pageThat.attr('lay-add');
                }else {
                     _pageUrl = pageThat.attr('lay-add');
                }
                
                if (typeof(_pageUrl) === 'undefined') {
                    layer.msg('按钮缺少 url 属性','info'); 
                    return false;
                }
                
                // 开始POST提交数据
                jquery.post(_pageUrl, 
                    post.field, function(res){
                        if (res.code == 200) {

                            layer.msg(res.msg);

                            // 更新列数据
                            if (typeof(tableThis) !== 'undefined') {
                                if (tableThis.event === 'edit')
                                    tableThis.update(JSON.parse(JSON.stringify(post.field)));
                            }else { // 添加则更新列表
                                renderTable(tableURL);
                            }

                            // 调用接口更新菜单
                            top.layui.admin.reloadLayout();

                            // 关闭当前窗口
                            layer.close(colletction.index);
                        }else {
                            layer.error(res.msg);
                        }
                }, 'json');

                return false;                        
            })
        }

        // 展开所有
        jquery('#expandAll').click(function(){
            treetable.expandAll('#lay-tableList');
        })

        // 折叠所有
        jquery('#foldAll').click(function () {
            treetable.foldAll('#lay-tableList');
        });

        // 执行初始化
        renderTable(tableURL);
    });

</script>
