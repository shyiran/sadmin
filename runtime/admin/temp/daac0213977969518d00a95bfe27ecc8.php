<?php /*a:3:{s:53:"D:\SwiftAdmin\app\admin\view\system\admin\center.html";i:1659669829;s:47:"D:\SwiftAdmin\app\admin\view\public\header.html";i:1664337374;s:47:"D:\SwiftAdmin\app\admin\view\public\footer.html";i:1659669829;}*/ ?>
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
<!-- 正文开始 -->
<style>
    .text-center {
        text-align: center;
    }
    .user-info-head {
        width: 110px;
        height: 110px;
        position: relative;
        display: inline-block;
        border-radius: 50%;
        border: 2px solid #eee;
    }

    .user-info-head:hover:after {
        content: '\e65d';
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        color: #eee;
        background: rgba(0, 0, 0, 0.5);
        font-family: layui-icon;
        font-size: 24px;
        font-style: normal;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        cursor: pointer;
        line-height: 110px;
        border-radius: 50%;
    }

    .user-info-head img {
        width: 110px;
        height: 110px;
        border-radius: 50%;
    }

    .info-list-item {
        position: relative;
        padding-bottom: 8px;
    }

    .info-list-item > .layui-icon {
        position: absolute;
    }

    .info-list-item > p {
        padding-left: 30px;
    }

    .dash {
        border-bottom: 1px dashed #ccc;
        margin: 15px 0;
    }

    .bd-list-item {
        padding: 14px 0;
        border-bottom: 1px solid #e8e8e8;
        position: relative;
    }

    .bd-list-item .bd-list-item-img {
        width: 48px;
        height: 48px;
        line-height: 48px;
        margin-right: 12px;
        display: inline-block;
        vertical-align: middle;
    }

    .bd-list-item .bd-list-item-content {
        display: inline-block;
        vertical-align: middle;
    }

    .bd-list-item .bd-list-item-lable {
        margin-bottom: 4px;
        color: #333;
    }

    .bd-list-item .bd-list-item-oper {
        position: absolute;
        right: 0;
        top: 50%;
        text-decoration: none !important;
        cursor: pointer;
        transform: translateY(-50%);
    }

    .user-info-form .layui-form-item {
        margin-bottom: 25px;
    }

    .editMood {
        margin-top:8px;
        height: 22px;
    }
    .editTags {
        height: 22px;
        font-size: 12px;
    }

    .layui-badge-list span .layui-icon {
        right: 2px;
        top: 4px;
        z-index: 9999;
        color: red;
        width: 13px;
        height: 13px;
        line-height: 13px;
        border-radius: 50%;
        font-size: 10px;
        position: absolute;
        display: none;
    }

    .layui-badge-list span:hover .layui-icon {
        display: block;
        background-color: #FF5722;
        color: #fff;
    }

    .layui-badge-list .layui-badge {
        padding: 0px 7px;
        border: 1px solid #ccc;
        margin-bottom: 8px;
        background-color: #fafafa!important;
    }

</style>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <!-- 左 -->
        <div class="layui-col-sm12 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-body" style="padding: 25px;">
                    <div class="text-center layui-text">
                        <div class="user-info-head" id="imgHead" lay-upload="imgHead" data-url="<?php echo url('/ajax/upload/'); ?>?action=avatar" callback="imgHead">
                            <img src="<?php echo htmlentities($data['face']); ?>" class="imgHead" />
                        </div>
                        <h2 style="padding-top: 20px;"><?php echo htmlentities((isset($data['nickname']) && ($data['nickname'] !== '')?$data['nickname']:'没有昵称')); ?></h2>
                        <p style="padding-top: 8px;" class="userMood" ><?php echo htmlentities((isset($data['mood']) && ($data['mood'] !== '')?$data['mood']:'双击修改您的心情吧')); ?></p>
                    </div>
                    <div class="layui-text" style="padding-top: 30px;">
                        <div class="info-list-item">
                            <i class="layui-icon layui-icon-username"></i>
                            <p><?php echo htmlentities((isset($data['jobs']) && ($data['jobs'] !== '')?$data['jobs']:'未分配')); ?></p>
                        </div>
                        <div class="info-list-item">
                            <i class="layui-icon layui-icon-release"></i>
                            <p><?php echo htmlentities((isset($data['group']) && ($data['group'] !== '')?$data['group']:'未分配')); ?></p>
                        </div>
                        <div class="info-list-item">
                            <i class="layui-icon layui-icon-location"></i>
                            <p><?php echo htmlentities((isset($data['address']) && ($data['address'] !== '')?$data['address']:'未填写')); ?></p>
                        </div>
                    </div>
                    <div class="dash"></div>
                    <h3><?php echo __('标签'); ?> <i class="layui-inputags layui-icon layui-icon-add-1" style="color: #666"></i> </h3>
                    <div class="layui-badge-list" style="padding-top: 6px;"> <?php if(is_array($data['tags']) || $data['tags'] instanceof \think\Collection || $data['tags'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['tags'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <span class="layui-badge layui-bg-gray"><i class="layui-icon layui-icon-close"></i><?php echo htmlentities($vo); ?></span>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- 右 -->
        <div class="layui-col-sm12 layui-col-md9">
            <div class="layui-card">
                <div class="layui-card-body">

                    <div class="layui-tab layui-tab-brief" lay-filter="userInfoTab">
                        <ul class="layui-tab-title">
                            <li class="layui-this"><?php echo __('基本信息'); ?></li>
                            <li><?php echo __('账号绑定'); ?></li>
                        </ul>
                        <div class="layui-tab-content">
                            <div class="layui-tab-item layui-show">

                                <form action="<?php echo url('/system.admin/center'); ?>" class="layui-form user-info-form layui-text" style="max-width: 400px;padding-top: 25px;">
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo __('邮箱'); ?>:</label>
                                        <div class="layui-input-block">
                                            <input type="text" name="email" value="<?php echo htmlentities($data['email']); ?>"
                                                   class="layui-input" lay-verify="required" required/>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo __('昵称'); ?>:</label>
                                        <div class="layui-input-block">
                                            <input type="text" name="nickname" value="<?php echo htmlentities($data['nickname']); ?>"
                                                   class="layui-input" lay-verify="required" required/>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo __('个人简介'); ?>:</label>
                                        <div class="layui-input-block">
                                            <textarea name="content" placeholder="<?php echo __('个人简介'); ?>" class="layui-textarea"><?php echo htmlentities($data['content']); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo __('街道地址'); ?>:</label>
                                        <div class="layui-input-block">
                                            <input type="text" name="address" value="<?php echo htmlentities($data['address']); ?>"
                                                   class="layui-input" lay-verify="required" required/>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo __('联系电话'); ?>:</label>
                                        <div class="layui-input-block">
                                            <input type="text" name="area" value="<?php echo htmlentities($data['area']); ?>" style="width: 60px;"
                                                   class="layui-input" lay-verify="required" required/>
                                            <div style="position: absolute;left: 65px;right: 0;top: 0;">
                                                <input type="text" name="mobile" value="<?php echo htmlentities($data['mobile']); ?>" class="layui-input"
                                                       lay-verify="required|phone" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <div class="layui-input-block">
                                            <button class="layui-btn" lay-filter="submitIframe" type="button" lay-submit><?php echo __('更新基本信息'); ?></button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="layui-tab-item" style="padding: 6px 25px 30px 25px;">

                                <div class="bd-list layui-text">
                                    <div class="bd-list-item">
                                        <div class="bd-list-item-content">
                                            <div class="bd-list-item-lable"><?php echo __('密保手机'); ?></div>
                                            <div class="bd-list-item-text"><?php echo __('已绑定手机'); ?>：<?php echo htmlentities($data['mobile']); ?></div>
                                        </div>
                                        <a class="bd-list-item-oper"><?php echo __('修改'); ?></a>
                                    </div>
                                    <div class="bd-list-item">
                                        <div class="bd-list-item-content">
                                            <div class="bd-list-item-lable"><?php echo __('密保邮箱'); ?></div>
                                            <div class="bd-list-item-text"><?php echo __('已绑定邮箱'); ?>：<?php echo htmlentities($data['email']); ?></div>
                                        </div>
                                        <a class="bd-list-item-oper"><?php echo __('修改'); ?></a>
                                    </div>
                                    <div class="bd-list-item">
                                        <div class="bd-list-item-img">
                                            <i class="layui-icon layui-icon-login-qq"
                                               style="color: #3492ED;font-size: 48px;"></i>
                                        </div>
                                        <div class="bd-list-item-content">
                                            <div class="bd-list-item-lable"><?php echo __('绑定QQ'); ?></div>
                                            <div class="bd-list-item-text"><?php echo __('当前未绑定QQ账号'); ?></div>
                                        </div>
                                        <a class="bd-list-item-oper"><?php echo __('绑定'); ?></a>
                                    </div>
                                    <div class="bd-list-item">
                                        <div class="bd-list-item-img">
                                            <i class="layui-icon layui-icon-login-wechat"
                                               style="color: #4DAF29;font-size: 48px;"></i>
                                        </div>
                                        <div class="bd-list-item-content">
                                            <div class="bd-list-item-lable"><?php echo __('绑定微信'); ?></div>
                                            <div class="bd-list-item-text"><?php echo __('当前未绑定绑定微信账号'); ?></div>
                                        </div>
                                        <a class="bd-list-item-oper"><?php echo __('绑定'); ?></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
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
    layui.use(['admin'],function() {
        var admin = layui.admin;
        var jquery = layui.jquery;
        
        admin.callback.imgHead = function(clickthis, colletction) {

            var res = colletction.res;
            if (res.code == 200) { // 查找元素
                jquery('.imgHead').attr('src',res.url);
                // // 执行后端投递工作
                // jquery.post('<?php echo url("/system.admin/modify"); ?>',{
                //     field: 'face'
                //     ,face: res.url
                // },function(res) {
                //     layer.msg("<?php echo __('上传成功'); ?>");
                // })
            }
            else {
                layer.error(res.msg);
            }
        }

        // 编辑签名
        jquery('.userMood').dblclick(function() {
            var that = jquery(this),
                html = that.text(); that.hide();
                jquery(that).parent().append('<input class="editMood layui-input" type="text" maxlength="12" value="' + html +'">');
        })

        jquery('.layui-card-body').on('blur','.editMood',function() {
             var that = jquery(this),
                html = that.val(); that.remove();
                jquery('.userMood').text(html);
                jquery('.userMood').show();
                jquery.post('<?php echo url("/system.admin/modify"); ?>',{
                    field: 'mood'
                    ,mood: html
                },function(res) {
                })
        })

        jquery('.layui-inputags').click(function(){
            if (jquery('.editTags').length <= 0) {
                jquery(this).parent().append('<input class="editTags layui-input" type="text" maxlength="10">');
            }
        })

        // 添加标签
        jquery('.layui-card-body').on('blur','.editTags',function() {
             var that = jquery(this),
                 html = that.val(); that.remove();
                 if (html == '') {
                    return;
                 }    
            jquery.post('<?php echo url("/system.admin/modify"); ?>',{
                field: 'tags'
                ,tags: html
            },function(res) {
                if (res.code == 200) {
                    var elem = '\n';
                    elem += '<span class="layui-badge layui-bg-gray">';
                    elem += '<i class="layui-icon layui-icon-close"></i>';
                    elem += html;
                    elem += '</span>';
                    jquery('.layui-badge-list').append(elem);
                }else {
                    layer.error(res.msg);
                }
            })                       
        })

        // 删除标签
        jquery('.layui-card-body').on('click','.layui-badge-list i',function() {
            var that = jquery(this),
             html = that.parent('span').text();
            jquery.post('<?php echo url("/system.admin/modify"); ?>',{
                field: 'tags'
                ,del: 1
                ,tags: html
            },function(res) {
                if (res.code == 200) {
                    that.parent('span').remove();
                }else {
                    layer.error(res.msg);
                }
            })             
        })

        layer.tips('双击心情可以编辑','.userMood',{
            tips: [1, '#000']
        })

        // 后端绑定操作
        // TODO...
    })
</script>