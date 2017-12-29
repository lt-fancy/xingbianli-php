<?php
/**
 * Created by PhpStorm.
 * User: sawallianc
 * Date: 2017/9/28 0028
 * Time: 11:25
 */
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="lib/html5shiv.js"></script>
    <script type="text/javascript" src="lib/respond.min.js"></script>
    <![endif]-->
    <link href="static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css"/>
    <link href="static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>杭州淘货货网络科技有限公司CMS系统</title>
</head>
<body>
<div class="header"></div>
<div class="loginWraper">
    <div id="loginform" class="loginBox">
        <form class="form form-horizontal">
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                <div class="formControls col-xs-8">
                    <input id="account" name="account" type="text" placeholder="账户" class="input-text size-L">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input id="password" name="password" type="password" placeholder="密码" class="input-text size-L">
                </div>
            </div>

            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input id="checkcode" name="checkcode" class="input-text size-L" type="text" placeholder="验证码"
                           style="width:150px;">
                    <img id="checkpic" src='./checkcode.php?'/> <a id="kanbuq" href="javascript:changing();">看不清，换一张</a>
                </div>
            </div>
            <div id="msg" style="margin-left: 160px;color: #ff020c"></div>
            <div id="errmsg" style="margin-left: 160px;color: #ff020c"></div>
            <div class="row cl">
            </div>
            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input id="login" name="" type="button" class="btn btn-success radius size-L"
                           value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
                    <input name="" type="reset" class="btn btn-default radius size-L"
                           value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="footer">CopyRight © 杭州淘货货网络科技有限公司</div>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="my/context.js"></script>
<script>
    function changing() {
        $("#checkpic").attr('src', "./checkcode.php?" + Math.random());
    }

    $(function (){
        $(document).keydown(function (event) {
            if (event.keyCode == 13) {
                $("#login").click();
            }
        });
    });
    $("#login").click(function () {
        var user = $("#account").val();
        var pass = $("#password").val();
        var checkcode = $("#checkcode").val();
        if (user == "") {
            $("#msg").html("用户名不能为空！").appendTo('.sub').fadeOut(2000);
            $("#account").focus();
            return false;
        }
        if (pass == "") {
            $("#msg").html("密码不能为空！").appendTo('.sub').fadeOut(2000);
            $("#password").focus();
            return false;
        }
        if (checkcode == "") {
            $("#msg").html("验证码不能为空！").appendTo('.sub').fadeOut(2000);
            $("#checkcode").focus();
            return false;
        }
        $.ajax({
            type: "POST",
            url: "doLogin.php",
            dataType: "json",
            data: {"account": user, "password": pass, "checkcode": checkcode},
            beforeSend: function () {
                $("#msg").addClass("loading").html("正在登录...").css("color", "#999").appendTo('.sub');
            },
            success: function (json) {
                if (json.success == 1) {
                    window.location.href = getContextPath() + "home.php";
                } else {
                    $("#msg").remove();
                    $("#errmsg").html(json.msg).appendTo('.sub').fadeOut(2000);
                    return false;
                }
            }
        });
    });
</script>
</body>
</html>
