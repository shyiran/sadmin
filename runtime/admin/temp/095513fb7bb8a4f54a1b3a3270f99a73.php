<?php /*a:1:{s:45:"D:\SwiftAdmin\app\admin\view\login\index.html";i:1659669829;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"> 
<title>swiftAdmin <?php echo __('后台登录'); ?></title>
<link href="/favicon.ico" rel="icon">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-status-bar-style" content="black"> 
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<link href="/static/system/layui/css/layui.css?v=<?php echo release(); ?>" rel="stylesheet" type="text/css" />
<link href="/static/system/css/login.css?v=<?php echo release(); ?>" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="swiftadmin-login">
        <div class="swiftadmin-login-main">
            <!-- // 头部信息2 -->  
            <div class="swiftadmin-login-box swiftadmin-login-header">
                <h2><img  src="/static/system/images//logo.png" alt="logo" class="logo">Swift Admin</h2>
                <p>SwiftAdmin.NET 最懂你的极速开发框架管理后台 </p>
            </div>
            <!-- // 登录页面 -->
            <div id="login" class="swiftadmin-login-box swiftadmin-login-body layui-form" style="display: block;">
                <form action="<?php echo url('/login/index'); ?>" method="post" class="layui-form layui-form-pane login" >
                    <input type="hidden" name="__token__" value="<?php echo token(); ?>" />
                    <div class="layui-form-item">
                        <div class="item">
                            <label class="swiftadmin-login-icon layui-icon layui-icon-username" ></label>
                            <input type="text" name="name" lay-verify="required" placeholder="<?php echo __('用户名'); ?>" class="layui-input layui-form-danger">
                        </div>
                    </div>

                    <div class="layui-form-item"> 
                        <div class="item">
                            <label class="swiftadmin-login-icon layui-icon layui-icon-password" ></label>
                            <input type="password" name="pwd" lay-verify="required" placeholder="<?php echo __('密码'); ?>" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item" <?php if(empty($captcha) || (($captcha instanceof \think\Collection || $captcha instanceof \think\Paginator ) && $captcha->isEmpty())): ?>style="display:none;"<?php endif; ?> >
                        <div class="layui-row">
                            <div class="layui-col-xs7 item">
                            <label class="swiftadmin-login-icon layui-icon layui-icon-vercode" ></label>
                            <input type="text" name="captcha"  placeholder="<?php echo __('图形验证码'); ?>" class="layui-input">
                            </div>
                            <div class="layui-col-xs3 fr">
                                <div class="captcha fr" ><a href="javascript:;" ><img src="<?php echo captcha_src(); ?>" height="36" id="captchaImg" alt="<?php echo __('验证码'); ?>"  /></a></div>
                            </div>
                        </div>
                    </div>

                    <div class="layui-form-item" style="margin-bottom: 20px;">
                        <div class="fl">
                            <input type="checkbox" name="remember" lay-skin="primary" title="<?php echo __('记住密码'); ?>" checked>
                        </div>
                        <a lay-href="forget.html" sa-event-type="forget" class="swiftadmin-user-jump-change swiftadmin-link" style="margin-top: 7px;"><?php echo __('忘记密码？'); ?></a>
                    </div>     

                    <div class="layui-form-item">
                        <input type="submit" value="<?php echo __('登录'); ?>" lay-submit="" lay-filter="login" class="layui-btn layui-btn-fluid layui-btn-normal">
                    </div>
                    <div class="layui-trans layui-form-item swiftadmin-login-other">
                        <div class="other-login fl">
                            <label><?php echo __('其他登录方式'); ?></label>
                            <a href="javascript:;"><i class="layui-icon layui-icon-login-qq"></i></a>
                            <a href="javascript:;"><i class="layui-icon layui-icon-login-wechat"></i></a>
                            <a href="javascript:;"><i class="layui-icon layui-icon-login-weibo"></i></a>
                        </div>
                        <a sa-event-type="register"  class="swiftadmin-user-jump-change swiftadmin-link"><?php echo __('注册帐号'); ?></a>
                    </div>
                </form>
            </div>

            <!-- // 注册页面 -->
            <div id="register" class="swiftadmin-login-box swiftadmin-login-body layui-form" style="display: none;">
                <form action="<?php echo url('/login/register'); ?>" method="post" class="layui-form layui-form-pane register" >
                    <div class="layui-form-item item">
                        <label class="swiftadmin-login-icon layui-icon layui-icon-cellphone" ></label>
                        <input type="text" name="email" lay-verify="required|email" placeholder="<?php echo __('请输入邮箱'); ?>" class="layui-input">
                    </div>
                    <div class="layui-form-item">

                        <div class="layui-row">
                        <div class="layui-col-xs7 item">
                            <label class="swiftadmin-login-icon layui-icon layui-icon-vercode" ></label>
                            <input type="text" name="captchar" lay-verify="required" placeholder="<?php echo __('验证码'); ?>" class="layui-input">
                        </div>
                        <div class="layui-col-xs3 fr"> 
                            <div class="captcha fr" ><a href="javascript:;" ><img src="<?php echo captcha_src(); ?>" height="36" id="captchaImg2" alt="<?php echo __('验证码'); ?>"  /></a></div>
                        </div> 
                        </div>
                    </div>
                    <div class="layui-form-item item">
                        <label class="swiftadmin-login-icon layui-icon layui-icon-password" ></label>
                        <input type="password" name="pass" lay-verify="required" placeholder="<?php echo __('密码'); ?>" class="layui-input">
                    </div>
                    <div class="layui-form-item item">
                        <label class="swiftadmin-login-icon layui-icon layui-icon-password" ></label>
                        <input type="password" name="repass" lay-verify="required" placeholder="<?php echo __('确认密码'); ?>" class="layui-input">
                    </div>
                    <div class="layui-form-item item">
                        <label class="swiftadmin-login-icon layui-icon layui-icon-username" ></label>
                        <input type="text" name="nickname" lay-verify="required|nickname" placeholder="<?php echo __('昵称'); ?>" class="layui-input">
                    </div>
                    <div class="layui-form-item">
                        <div class="fl">
                            <input type="checkbox" name="agreement" lay-skin="primary" title="<?php echo __('同意用户协议'); ?>" checked="">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <input type="submit" value="<?php echo __('注 册'); ?>" lay-submit="" lay-filter="register" class="layui-btn layui-btn-fluid layui-btn-normal">
                    </div>
                    <div class="layui-trans layui-form-item swiftadmin-login-other">
                        <div class="other-login fl">
                            <label><?php echo __('社交账号注册'); ?></label>
                            <a href="javascript:;"><i class="layui-icon layui-icon-login-qq"></i></a>
                            <a href="javascript:;"><i class="layui-icon layui-icon-login-wechat"></i></a>
                            <a href="javascript:;"><i class="layui-icon layui-icon-login-weibo"></i></a>
                        </div>
                        <a href="javascript:;" sa-event-type="login" class="swiftadmin-user-jump-change swiftadmin-link layui-hide-xs"><?php echo __('用已有帐号登入'); ?></a>
                        <a href="javascript:;" sa-event-type="login" class="swiftadmin-user-jump-change swiftadmin-link layui-hide-sm layui-show-xs-inline-block"><?php echo __('登入'); ?></a>
                    </div>
                </form>
            </div>
            <!-- // 找回密码页面 -->
            <div id="forget" class="swiftadmin-login-box swiftadmin-login-body layui-form"  style="display: none;" >
                <form action="<?php echo url('/login/forget'); ?>" method="post" class="layui-form layui-form-pane register" >
                <div class="layui-form-item item">
                     <label class="swiftadmin-login-icon layui-icon layui-icon-cellphone"></label> 
                     <input type="text" name="emailphone" lay-verify="required" placeholder="<?php echo __('请输入手机号或者邮箱'); ?>" class="layui-input">
                </div>
                <div class="layui-form-item imgcode"> 
                    <div class="layui-row"> 
                        <div class="layui-col-xs7 item"> 
                            <label class="swiftadmin-login-icon layui-icon layui-icon-vercode" ></label> 
                            <input type="text" name="imgcode" lay-verify="required" placeholder="<?php echo __('图形验证码'); ?>" class="layui-input">
                        </div> 

                        <div class="layui-col-xs3 fr"> 
                            <div class="captcha fr" ><a href="javascript:;" ><img src="<?php echo captcha_src(); ?>" height="36" id="captchaImg3" alt="<?php echo __('验证码'); ?>"  /></a></div>
                        </div> 
                    </div> 
                </div>   
                
                <div class="layui-form-item valicode item" style="display: none"> 
                    <div class="layui-row"> 
                        <label class="swiftadmin-login-icon layui-icon layui-icon-vercode" ></label> 
                        <input type="text" name="valicode" placeholder="<?php echo __('短信邮件验证码'); ?>" class="layui-input"> 
                    </div> 
                </div> 

                <div class="settingPwd" style="display: none;">
                    <div class="layui-form-item item">
                        <label class="swiftadmin-login-icon layui-icon layui-icon-password" ></label>
                        <input type="password" name="pwds"  placeholder="<?php echo __('密码'); ?>" class="layui-input">
                    </div>
                    <div class="layui-form-item item">
                        <label class="swiftadmin-login-icon layui-icon layui-icon-password" ></label>
                        <input type="password" name="repwds"  placeholder="<?php echo __('确认密码'); ?>" class="layui-input">
                    </div>                 
                </div>

                <div class="layui-form-item"> 
                    <button class="layui-btn layui-btn-fluid layui-btn-normal layui-btn-fixed" lay-submit=""><?php echo __('获取验证码'); ?></button> 
                </div>
                <div class="layui-trans layui-form-item swiftadmin-login-other">
                    <div class="other-login fl">
                        <label><?php echo __('社交账号注册'); ?></label>
                        <a href="javascript:;"><i class="layui-icon layui-icon-login-qq"></i></a>
                        <a href="javascript:;"><i class="layui-icon layui-icon-login-wechat"></i></a>
                        <a href="javascript:;"><i class="layui-icon layui-icon-login-weibo"></i></a>
                    </div>
                    <a href="javascript:;" sa-event-type="login" class="swiftadmin-user-jump-change swiftadmin-link layui-hide-xs"><?php echo __('用已有帐号登入'); ?></a>
                    <a href="javascript:;" sa-event-type="login" class="swiftadmin-user-jump-change swiftadmin-link layui-hide-sm layui-show-xs-inline-block"><?php echo __('登入'); ?></a>
                </div>
                </form>
            </div>
        </div>

        <div class="layui-trans swiftadmin-login-footer">
            <p>
                <a href="#" target="_blank"><?php echo __('帮助'); ?></a>
                <a href="#" target="_blank"><?php echo __('隐私'); ?></a>
                <a href="#" target="_blank"><?php echo __('条款'); ?></a>
            </p>
            <p><div class="copyright"> Copyright © 2020 swiftAdmin.net co., ltd</div></p>
        </div>
    </div>
</body>
<script src="/static/system/layui/layui.js?v=<?php echo release(); ?>"></script>
<script src="/static/system/js/common.js?v=<?php echo release(); ?>"></script>
<script>
    window.sessionStorage.clear();
    layui.use(['layer','form'],function() {
        var $ = layui.jquery, 
        layer = layui.layer, 
        form = layui.form,
        captchaUrl = '<?php echo captcha_src(); ?>';

        // 登录操作
        form.on('submit(login)', function(data) {
            var that = $(this), _form = that.parents('form'),
                name = $('input[name="name"]').val(),
                pwd = $('input[name="pwd"]').val(),
                captcha = $('input[name="captcha"]').val(),
                __token__ = $('input[name="__token__"]').val();
            layer.msg("<?php echo __('数据提交中...'); ?>",'warning');
            that.prop('disabled', true);
            $_ajax(that,{name: name, pwd: pwd, captcha: captcha,__token__:__token__});
            return false;
        })

        
        /**
         * 注册账户$(this).serialize(),
        */
        form.on('submit(register)',function(data){
            
            var that = $(this), _form = that.parents('form'),
            name = $('input[name="nickname"]').val(),
            pass = $('input[name="pass"]').val(),
            repass = $('input[name="repass"]').val(),
            captcha = $('input[name="captchar"]').val(),
            email = $('input[name="email"]').val();
            
            if (pass != repass) {
                layer.msg("<?php echo __('两次输入密码不同'); ?>",'error');
                return false;
            }

            layer.msg("<?php echo __('数据提交中...'); ?>",'warning');
            that.prop('disabled', true);
            $_ajax(that,{name: name, pwd: pass, email:email,captcha: captcha});
            return false;
        })

        /*
         * 分步表单1 获取验证码
        */ 
        $('.layui-btn-fixed').click(function() {
            if ($(this).hasClass('layui-btn-fixed') ==  false) {

                return false;
            }
            var name = $('input[name="emailphone"]').val(),
            captcha = $('input[name="imgcode"]').val();          
            $.ajax({
                type: "POST",
                url: "<?php echo url('/login/valicode'); ?>",
                data: {name:name,captcha:captcha},
                success: function (res) {
                    if(res.code == 200){
                        layer.msg(res.msg,function(){
                            $('.imgcode').css('display','none');
                            $('.valicode').css('display','block');
                            $('.layui-btn-fixed').attr('lay-filter','forget');
                            // 移除click事件
                            $('.layui-btn-fixed').text("<?php echo __('下一步'); ?>").off('click');
                            $('.layui-btn-fixed').removeClass('layui-btn-fixed');
                        });

                    }else {
                        layer.msg(res.msg,function() {
                            $("#captchaImg,#captchaImg2,#captchaImg3").attr('src',captchaUrl+'?rand='+Math.random()).parents('.layui-form-item').show();
                        });
                    }
                }
            })

            return false;
        })


        /**
         * 分步表单2 验证账户权限
        */
        form.on('submit(forget)',function(data){

            var that = $(this),
            name = $('input[name="emailphone"]').val(),
            valicode = $('input[name="valicode"]').val();

            $.ajax({
                type: "POST",
                url: "<?php echo url('/login/forget'); ?>",
                data: {name:name,valicode:valicode},
                success: function (res) {
                    if(res.code == 200){
                        $('.valicode').css('display','none');
                        $('.settingPwd').css('display','block');
                        that.attr('lay-filter','settingPwd');
                        that.text("<?php echo __('立即设置'); ?>");
                    }else {
                        layer.msg(res.msg);
                    }
                }
            })

            return false;
        })


        /*
         * 分步表单3 提交设置密码
        */ 
        form.on('submit(settingPwd)',function(data){

            var name = $('input[name="emailphone"]').val(),
            pass = $('input[name="pwds"]').val(),
            repass = $('input[name="repwds"]').val(),
            valicode = $('input[name="valicode"]').val();
            
            if (pass != repass) {
                layer.msg("<?php echo __('两次输入密码不同'); ?>",'error')
                return false;
            }

            $.ajax({
                type: "POST",
                url: "<?php echo url('/login/setpwd'); ?>",
                data: {name:name,pass:pass,valicode:valicode},
                success: function (res) {
                    if(res.code == 200){
                        layer.msg(res.msg,function(){
                            location.reload();
                        });
                    }else {
                        layer.error(res.msg);
                    }
                }
            })

            return false;
        })


        /**
         * 提交数据
        */
        function $_ajax(that,data,jump) {
            
           var _form = that.attr('lay-filter'),
            _urls = $('.'+_form).attr('action');

            $.ajax({
                type: "POST",
                url: _urls,
                data: data,
                success: function (res) {

                    if(res.code == 200){

                        layer.msg(res.msg);

                        if (jump == undefined) {
                            window.location = res.url; // 跳转到主页
                        }
                    
                    }else {

                        layer.error(res.msg);
                        that.prop('disabled', false);
                        $("#captchaImg,#captchaImg2,#captchaImg3").attr('src',captchaUrl+'?rand='+Math.random()).parents('.layui-form-item').show();
                        if (res.data.token) {
                            $('input[name=__token__]').val(res.data.token);
                        }
                        
                        return false;
                    }
                },
                error: function() {
                    that.prop('disabled', false);
                    layer.msg("<?php echo __('好像是网络出错了...'); ?>",'error');
                }
            })
        }

        /**
         * 切换功能
        */
        $(document).on("click","*[sa-event-type]",function(){
            var array = ['login','register','forget'],
            event = $(this).attr("sa-event-type");
            for (var i in array) {
                if (array[i] != event) {
                    $('#' + array[i]).css('display','none');
                }
            }
            $('#' + event).css('display','block');
        })

        $(document).on('click', '#captchaImg,#captchaImg2,#captchaImg3', function(){
            $(this).attr('src', captchaUrl+'?rand='+Math.random())
        })
    })
</script>
</html>
