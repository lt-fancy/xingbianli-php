<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/10/13
 * Time: 13:49
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
</head>
<body>
<div class="page-container">
    <form method="post" class="form form-horizontal" id="form-article-add">
        <?PHP
        require_once 'mysql.php';
        $id = $_GET['id'];
        $sql = $mysqli->query("select * from text_info where id=$id");
        $sql_arr = mysqli_fetch_assoc($sql);
        $text=$sql_arr['text'];
        ?>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">详细内容：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <script id="myEditor" type="text/plain" style="height: 400px;width: 1000px;"></script>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button onClick="save();" class="btn btn-primary radius" type="button"><i
                        class="Hui-iconfont">&#xe632;</i> 保存
                </button>
                <button id="cancel" onClick="layer_close();" class="btn btn-default radius" type="button">
                    &nbsp;&nbsp;取消&nbsp;&nbsp;
                </button>
            </div>
        </div>
    </form>
</div>

<!--_footer 作为公共模版分离出去-->

<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->
<script type="text/javascript" src="third-party/template.min.js"></script>
<script type="text/javascript" charset="utf-8" src="third-party/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="third-party/umeditor.min.js"></script>
<script type="text/javascript" src="lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    var um = UM.getEditor('myEditor');
    var id = <?PHP echo $id;?>;
    $(window).load(function () {
        um.setContent('<?php echo $text;?>',true);
    });
    function save() {
        $.ajax({
            type: "POST",
            url: "base/textSave.php",
            dataType: "json",
            data: {"id": id, "text": um.getContent(),"text-without":um.getContentTxt()},
            success: function (json) {
                if (json.success == 1) {
                    layer.msg(json.msg, {
                        icon: 1,
                        time: 1500
                    },function () {
                        $("#cancel").click();
                    });
                } else {
                    layer.msg(json.msg, {
                        icon: 2,
                        time: 1500
                    },function () {
                        $("#cancel").click();
                    });
                }
            }
        });
    }
</script>
</body>
</html>
