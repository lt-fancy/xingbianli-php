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
    <script type="text/javascript" src="../lib/html5shiv.js"></script>
    <script type="text/javascript" src="../lib/respond.min.js"></script>

    <![endif]-->
    <link rel="stylesheet" type="text/css" href="../static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="../static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="../lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link href="../themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="../static/h-ui.admin/css/style.css"/>
    <link href="../lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="page-container">
    <form method="post" class="form form-horizontal" id="form-article-add">
        <?PHP
            require_once '../mysql.php';
            $id = $_GET['id'];
            $sql = $mysqli->query("select * from rack_info where id=$id");
            $sql_arr = mysqli_fetch_assoc($sql);
            $name=$sql_arr['rack_name'];
            $bizman=$sql_arr['bizman_id'];
            $replenishman=$sql_arr['replenishman_id'];
            $address=$sql_arr['rack_address'];
        ?>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>货架名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input id="name" type="text" class="input-text" value="<?PHP echo $name;?>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>货架地址：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input id="address" type="text" class="input-text" value="<?PHP echo $address;?>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>补货员：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select id="buhuo" name="" class="select">
                    <?php
                    $sql1 = $mysqli->query("select id,replenishman_name from replenishman_info where is_deleted=0");
                    $datarow1 = mysqli_num_rows($sql1); //长度
                    for($i=0;$i<$datarow1;$i++){
                        $sql_arr1 = mysqli_fetch_assoc($sql1);
                        $replenishmanName = $sql_arr1['replenishman_name'];
                        $replenishmanId = $sql_arr1['id'];
                        echo "<option value='$replenishmanId'>$replenishmanName</option>";
                    }
                    ?>
				</select>
				</span></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>业务员：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select id="biz" name="" class="select">
					<?php
                    $sql1 = $mysqli->query("select id,biz_man_name from biz_man_info where is_deleted=0");
                    $datarow1 = mysqli_num_rows($sql1); //长度
                    for($i=0;$i<$datarow1;$i++){
                        $sql_arr1 = mysqli_fetch_assoc($sql1);
                        $stateName = $sql_arr1['biz_man_name'];
                        $bizmanId = $sql_arr1['id'];
                        echo "<option value='$bizmanId'>$stateName</option>";
                    }
                    ?>
				</select>
				</span></div>
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

<script type="text/javascript" src="../lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="../lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="../static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="../static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->
<script type="text/javascript" src="../third-party/template.min.js"></script>
<script type="text/javascript" src="../lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript">
    $(window).load(function () {
        var buhuo = "<?PHP echo $replenishmanName?>";
        var biz = "<?PHP echo $stateName?>";
        $("#buhuo").val(buhuo);
        $("#biz").val(biz);
    });
    $("#name").blur(function () {
        var value = $(this).val();
        if(!checkIfNull(value)){
            layer.msg('货架名称不能为空', {
                icon: 2,
                time: 1500
            });
            $(this).focus();
        }
        if(value.length>100){
            layer.msg('货架名称输入过长', {
                icon: 2,
                time: 1500
            });
            $(this).val(null);
            $(this).focus();
        }
    });
    $("#address").blur(function () {
        var value = $(this).val();
        if(!checkIfNull(value)){
            layer.msg('商品原价不能为空', {
                icon: 2,
                time: 1500
            });
            $(this).focus();
        }
    });

    function checkIfNull(value) {
        var length = $.trim(value).length;
       return length>0;
    }
    function save() {
        var name = $("#name").val();
        var address = $("#address").val();
        var buhuo = $("#buhuo").val();
        var biz = $("#biz").val();
        if(!checkIfNull(name)){
            layer.msg('货架名称不能为空', {
                icon: 2,
                time: 1500
            });
            return false;
        }
        if(!checkIfNull(address)){
            layer.msg('货架地址不能为空', {
                icon: 2,
                time: 1500
            });
            return false;
        }
        if(!checkIfNull(buhuo)){
            layer.msg('补货员不能为空', {
                icon: 2,
                time: 1500
            });
            return false;
        }
        if(!checkIfNull(biz)){
            layer.msg('业务员不能为空', {
                icon: 2,
                time: 1500
            });
            return false;
        }
        var id = <?PHP echo $id==null?0:$id;?>;
        $.ajax({
            type: "POST",
            url: "../base/rackSave.php",
            dataType: "json",
            data: {"id": id, "name": name,"address":address,"buhuo":buhuo,"biz":biz},
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
