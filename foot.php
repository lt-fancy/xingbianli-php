<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/10/13
 * Time: 13:49
 */
require_once 'mysql.php';
$sql = $mysqli->query("select * from common_info where common_ename='foot' and is_deleted=0");
$sql_arr = mysqli_fetch_assoc($sql);
$content = $sql_arr['content'];
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
    <link rel="Bookmark" href="/favicon.ico">
    <link rel="Shortcut Icon" href="/favicon.ico"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="lib/html5shiv.js"></script>
    <script type="text/javascript" src="lib/respond.min.js"></script>

    <![endif]-->
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link href="themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css"/>
    <link href="lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="page-container">
    <form method="post" class="form form-horizontal" id="form-article-add">
        <div class="row cl">
            <div class="formControls col-xs-8 col-sm-9">
                <script id="myEditor" type="text/plain" style="width: 1300px;height: 200px;"></script>
                </div>
                </div>
                <div class="row cl">
                    <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <button onClick="save();" class="btn btn-primary radius" type="button"><i
                class="Hui-iconfont">&#xe632;</i> 保存
                </button>
                </div>
                </div>
                </form>
                </div>
                <script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
                <script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
                <script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>
                <script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->
                <script type="text/javascript" src="third-party/template.min.js"></script>
                <script type="text/javascript" src="lib/webuploader/0.1.5/webuploader.min.js"></script>
                <script type="text/javascript" charset="utf-8" src="third-party/umeditor.config.js"></script>
                <script type="text/javascript" charset="utf-8" src="third-party/umeditor.min.js"></script>
                <script type="text/javascript" src="lang/zh-cn/zh-cn.js"></script>
                <script type="text/javascript">
                    var um = UM.getEditor('myEditor');
                    um.setContent('<?php echo $content;?>',true);
                    function save() {
                        $.ajax({
                            type: "POST",
                            url: "base/commonSave.php",
                            dataType: "json",
                            data: {"ename": 'foot',"content":um.getContentTxt()},
                            success: function (json) {
                                if (json.success == 1) {
                                    layer.msg(json.msg, {
                                        icon: 1,
                                        time: 1500
                                    });
                                } else {
                                    layer.msg(json.msg, {
                                        icon: 2,
                                        time: 1500
                                    });
                                }
                            }
                        });
                    }

                </script>
</body>
</html>