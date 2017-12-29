<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/10/14
 * Time: 17:47
 */
$title = $_GET['title'];
$ename=$_GET['ename'];
require_once 'mysql.php';
$sql = $mysqli->query("select * from image_info where menu_ename='$ename'");
$datarow = mysqli_num_rows($sql); //长度
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="lib/html5shiv.js"></script>
    <script type="text/javascript" src="lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->

    <link href="lib/lightbox2/2.8.1/css/lightbox.css" rel="stylesheet" type="text/css" >
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 图片管理 <span class="c-gray en">&gt;</span> 图片展示 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a href="javascript:;" onclick="edit()" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe6df;</i> 编辑</a> </div>
    <div class="portfolio-content">
        <ul class="cl portfolio-area">
            <?php
                //循环遍历出数据表中的数据
                for($i=0;$i<$datarow;$i++){
                    $sql_arr = mysqli_fetch_assoc($sql);
                    $id=$sql_arr['id'];
                    $uri=$sql_arr['image_uri'];
                    $name=$sql_arr['image_title'];
                    echo " <li class='item'>
                    <div class='portfoliobox'>
                    <input class='checkbox' name='' type='checkbox' value='$id'>
                    <div class='picbox'><a href='../gfhd/html/images/$uri' data-lightbox='gallery' data-title='$name'><img src='../../images/$uri'></a></div>
                    <div class='textbox'>$uri </div>
                    </div>
                    </li>
                    ";
                }
            ?>
        </ul>
    </div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="lib/lightbox2/2.8.1/js/lightbox.min.js"></script>
<script type="text/javascript">
    $(function(){
        $(".portfolio-area li").Huihover();
    });
    function edit() {
        var length = <?PHP echo $datarow;?>;
        var title = '<?php echo $title; ?>';
        if (length == 1) {
            var id=<?php echo $id;?>;
            layer.open({
                type: 2,
                title: title,
                area: ['500px', '400px'],
                content: 'picture-edit.php?id='+id
            });
        } else {
            var vals = [];
            $('input:checkbox:checked').each(function (index, item) {
                var value = $(this).val();
                if (value > 0) {
                    vals.push($(this).val());
                }
            });
            if (vals.length == 0) {
                layer.msg('请选择一张图片', {
                    icon: 2,
                    time: 1500
                });
                return;
            }
            if (vals.length > 1) {
                layer.msg('只能选择一张图片', {
                    icon: 2,
                    time: 1500
                });
                return;
            }
            var index=layer.open({
                type: 2,
                title: title,
                area: ['500px', '300px'],
                content: 'picture-edit.php?id='+vals[0]
            });
        }

    }
</script>
</body>
</html>
