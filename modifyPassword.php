<?php
/**
 * Created by PhpStorm.
 * User: sawallianc
 * Date: 2017/9/28 0028
 * Time: 12:51
 */
session_start();
if(empty($_SESSION['isLogin'])){
    header("Location: login.php");
    exit();
}
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
</head>
<body>
<div class="loginWraper">
    <div id="modify" class="loginBox">
        <form class="form form-horizontal">
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                <div class="formControls col-xs-8">
                    <input id="old" name="old" type="password" placeholder="原密码" class="input-text size-L">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input id="new" name="new" type="password" placeholder="新密码" class="input-text size-L">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input id="confirm" name="confirm" type="password" placeholder="确认新密码" class="input-text size-L">
                </div>
            </div>
            <div id="msg" style="margin-left: 160px;color: #ff020c"></div>
            <div id="errmsg" style="margin-left: 160px;color: #ff020c"></div>
            <div class="row cl">
            </div>
            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input id="login" name="" type="button" class="btn btn-success radius size-L"
                           value="&nbsp;确&nbsp;&nbsp;&nbsp;&nbsp;认&nbsp;">
<!--                    <input name="" type="reset" class="btn btn-default radius size-L"-->
<!--                           value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">-->
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->
<script type="text/javascript">
    $("#login").click(function () {
        var old = $("#old").val();
        var newp = $("#new").val();
        var confirm = $("#confirm").val();
        if (old == "") {
            $("#msg").html("原密码不能为空！").appendTo('.sub').fadeOut(2000);
            $("#old").focus();
            return false;
        }
        if (newp == "") {
            $("#msg").html("新密码不能为空！").appendTo('.sub').fadeOut(2000);
            $("#new").focus();
            return false;
        }
        if (confirm == "") {
            $("#msg").html("确认密码不能为空！").appendTo('.sub').fadeOut(2000);
            $("#confirm").focus();
            return false;
        }
        $.ajax({
            type: "POST",
            url: "doModifyPassword.php",
            dataType: "json",
            data: {"old": old, "new": newp, "confirm": confirm},
            success: function (json) {
                if (json.success == 1) {
                    layer.msg('密码修改成功',{
                        icon:1,
                        time:2000
                    });
                } else {
                    $("#errmsg").html(json.msg).appendTo('.sub').fadeOut(2000);
                    return false;
                }
            }
        });
    });
</script>
</body>
</html>
