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
            $sql = $mysqli->query("select * from goods_info where id=$id");
            $sql_arr = mysqli_fetch_assoc($sql);
            $name=$sql_arr['goods_name'];
            $oldPrice=$sql_arr['goods_old_price'];
            $nowPrice=$sql_arr['goods_now_price'];
            $discount=$sql_arr['goods_discount'];
            $category=$sql_arr['goods_category'];
            $special=$sql_arr['is_special_price'];
            $limit=$sql_arr['is_limited'];
            $tag=$sql_arr['goods_tag'];
        ?>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input id="name" type="text" class="input-text" value="<?PHP echo $name;?>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品原价：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input id="oldPrice" type="text" class="input-text" value="<?PHP echo $oldPrice;?>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品现价：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input id="nowPrice" type="text" class="input-text" value="<?PHP echo $nowPrice;?>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品折扣：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input readonly="readonly" id="discount" type="text" class="input-text" value="<?PHP echo $discount;?>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品分类：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select id="category" name="" class="select">
                    <?php
                    $sql1 = $mysqli->query("select state_id,state_name from state_info where ename='goods_category' and is_deleted=0");
                    $datarow1 = mysqli_num_rows($sql1); //长度
                    for($i=0;$i<$datarow1;$i++){
                        $sql_arr1 = mysqli_fetch_assoc($sql1);
                        $stateName = $sql_arr1['state_name'];
                        $stateId = $sql_arr1['state_id'];
                        echo "<option value='$stateId'>$stateName</option>";
                    }
                    ?>
				</select>
				</span></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品标签：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select id="tag" name="" class="select">
					<?php
                    $sql1 = $mysqli->query("select state_id,state_name from state_info where ename='goods_tag' and is_deleted=0");
                    $datarow1 = mysqli_num_rows($sql1); //长度
                    for($i=0;$i<$datarow1;$i++){
                        $sql_arr1 = mysqli_fetch_assoc($sql1);
                        $stateName = $sql_arr1['state_name'];
                        $stateId = $sql_arr1['state_id'];
                        echo "<option value='$stateId'>$stateName</option>";
                    }
                    ?>
				</select>
				</span></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否特价：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select id="is_special" name="" class="select">
					<option value="0">是</option>
					<option value="1">否</option>
				</select>
				</span></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否限购：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select id="is_limit" name="" class="select">
					<option value="0">是</option>
					<option value="1">否</option>
				</select>
				</span></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">商品图片：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div class="uploader-thum-container">
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                </div>
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

<script type="text/javascript" src="../lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="../lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="../static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="../static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->
<script type="text/javascript" src="../third-party/template.min.js"></script>
<script type="text/javascript" src="../lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript">
    var special = <?php echo $special==null?1:$special; ?>;
    var limit = <?php echo $limit==null?1:$limit; ?>;
    var id = <?PHP echo $id==null?0:$id;?>;
    var image = "<?php echo $image ?>";
    var category = "<?php echo $category?>";
    var tag = "<?php echo $tag?>";
    var regp = /^[0-9]+([.]{1}[0-9]{1,2})?$/;
    $(window).load(function () {
        $("#is_special").val(special);
        $("#is_limit").val(limit);
        $("#category").val(category);
        $("#tag").val(tag);
        if(id > 0){
            //编辑
            var $li = $(
                "<div class='file-item thumbnail'>" +
                "<img style='width: 210px;height: 143px;' src='../../images/"+image+"'>"+
                "<div class='info'>" + image + "</div>" +
                "</div>"
                ),
                $img = $li.find('img');
            // $list为容器jQuery实例
            $("#fileList").html($li);
        }
    });
    function checkIfNumber(value){
        return regp.test(value);
    }
    $("#name").blur(function () {
        var value = $(this).val();
        if(!checkIfNull(value)){
            layer.msg('商品名称不能为空', {
                icon: 2,
                time: 1500
            });
            $(this).focus();
        }
        if(value.length>100){
            layer.msg('商品名称输入过长', {
                icon: 2,
                time: 1500
            });
            $(this).val(null);
            $(this).focus();
        }
    });
    $("#oldPrice").blur(function () {
        var value = $(this).val();
        if(!checkIfNull(value)){
            layer.msg('商品原价不能为空', {
                icon: 2,
                time: 1500
            });
            $(this).focus();
        }
        if(!checkIfNumber(value)){
            layer.msg('商品原价只能填入数字或最多两位小数', {
                icon: 2,
                time: 1500
            });
            $(this).focus();
        }
    });
    $("#nowPrice").blur(function () {
        var value = $(this).val();
        if(!checkIfNull(value)){
            layer.msg('商品现价不能为空', {
                icon: 2,
                time: 1500
            });
            $(this).focus();
        }
        if(!checkIfNumber(value)){
            layer.msg('商品现价只能填入数字或最多两位小数', {
                icon: 2,
                time: 1500
            });
            $(this).focus();
        }
        var now = parseFloat($(this).val());
        var old = parseFloat($("#oldPrice").val());
        if(checkIfNull(now) && checkIfNull(old)){
            $("#discount").val((old*100-now*100)/100);
        }
    });
    var uploader = WebUploader.create({

        // 选完文件后，是否自动上传。
        auto: true,

        // swf文件路径
        swf: '/themes/uploadify.swf',

        // 文件接收服务端。
        server: '../base/imageUpload.php',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',

        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        },
        method:'post',
//        fileSingleSizeLimit:409600
    });
    // 当有文件添加进来的时候
    uploader.on('fileQueued', function (file) {
        var $li = $(
            '<div id="' + file.id + '" class="file-item thumbnail">' +
            '<img>' +
            '<div class="info">' + file.name + '</div>' +
            '</div>'
            ),
            $img = $li.find('img');
            image = file.name;

        // $list为容器jQuery实例
        $("#fileList").html($li);

        // 创建缩略图
        // 如果为非图片文件，可以不用调用此方法。
        // thumbnailWidth x thumbnailHeight 为 100 x 100
        uploader.makeThumb(file, function (error, src) {
            if (error) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }

            $img.attr('src', src);
        }, 210, 143);
    });
    // 文件上传过程中创建进度条实时显示。
    uploader.on('uploadProgress', function (file, percentage) {
        var $li = $('#' + file.id),
            $percent = $li.find('.progress span');

        // 避免重复创建
        if (!$percent.length) {
            $percent = $('<p class="progress"><span></span></p>')
                .appendTo($li)
                .find('span');
        }

        $percent.css('width', percentage * 100 + '%');
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on('uploadSuccess', function (file,response) {
        $('#' + file.id).addClass('upload-state-done');
    });

    // 文件上传失败，显示上传出错。
    uploader.on('uploadError', function (file,response) {
        console.log(response);
        var $li = $('#' + file.id),
            $error = $li.find('div.error');

        // 避免重复创建
        if (!$error.length) {
            $error = $('<div class="error"></div>').appendTo($li);
        }

        $error.text('上传失败');
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on('uploadComplete', function (file) {
        $('#' + file.id).find('.progress').remove();
    });

    function checkIfNull(value) {
        var length = $.trim(value).length;
       return length>0;
    }
    function save() {
        var name = $("#name").val();
        var nowPrice = $("#nowPrice").val();
        var oldPrice = $("#oldPrice").val();
        var discount = $("#discount").val();
        var category = $("#category").val();
        var special = $("#is_special").val();
        var limit = $("#is_limit").val();
        var tag = $("#tag").val();
        if(!checkIfNull(name)){
            layer.msg('商品名称不能为空', {
                icon: 2,
                time: 1500
            });
            return false;
        }
        if(!checkIfNull(nowPrice)){
            layer.msg('商品现价不能为空', {
                icon: 2,
                time: 1500
            });
            return false;
        }
        if(!checkIfNull(oldPrice)){
            layer.msg('商品原价不能为空', {
                icon: 2,
                time: 1500
            });
            return false;
        }
        if(!checkIfNull(discount)){
            layer.msg('商品折扣不能为空', {
                icon: 2,
                time: 1500
            });
            return false;
        }
        $.ajax({
            type: "POST",
            url: "../base/goodsSave.php",
            dataType: "json",
            data: {"id": id, "name": name,"nowPrice":nowPrice,"oldPrice":oldPrice,"discount":discount,"category":category,
            "special":special,"limit":limit,"tag":tag},
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
