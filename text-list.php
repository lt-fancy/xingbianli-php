<?PHP
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
    <title>文本列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 文本管理 <span class="c-gray en">&gt;</span> 文本列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                <th hidden="hidden">ID</th>
                <th hidden="hidden">ename</th>
                <th hidden="hidden">text</th>
                <th width="100">所属菜单</th>
                <th width="100">所属父级菜单</th>
                <th width="100">文本内容</th>
                <th width="150">更新时间</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once 'mysql.php';
            $sql = $mysqli->query("select * from text_info order by is_deleted asc");
            $datarow = mysqli_num_rows($sql); //长度
            //循环遍历出数据表中的数据
            for($i=0;$i<$datarow;$i++){
                $sql_arr = mysqli_fetch_assoc($sql);
                $id=$sql_arr['id'];
                $ename=$sql_arr['menu_ename'];
                $parentName = '';
                $sql1 = $mysqli->query("select * from menu_info where menu_ename='$ename' and is_deleted=0");
                $sql_arr1 = mysqli_fetch_assoc($sql1);
                $cname = $sql_arr1['menu_cname'];
                $parentId = $sql_arr1['parent_id'];
                if($parentId==null){
                    //不存在父级菜单，自己就是父级
                    $parentName='-';
                } else {
                    $sql2=$mysqli->query("select * from menu_info where id=$parentId");
                    $sql_arr2 = mysqli_fetch_assoc($sql2);
                    $parentName=$sql_arr2['menu_cname'];
                }
                $textWithout=$sql_arr['text_without'];
                $text=$sql_arr['text'];
                $time=$sql_arr['gmt_modified'];
                echo "<tr class='text-c'>
                            <td class='text_id' hidden='hidden'>$id</td>
                            <td class='ename' hidden='hidden'>$ename</td>
                            <td class='text-with' hidden='hidden'>$text</td>
                            <td class='cname'>$cname</td>
                            <td>$parentName</td>
                            <td class='text-without'>$textWithout</td>
                            <td>$time</td>
                            <td class='f-14 td-manage'><a style='text-decoration:none' onClick='edit(this.parentNode)' href='javascript:;' title='编辑'><i class='Hui-iconfont' style='font-size: large'>&#xe6df;</i></a></td>
                    ";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    var table = $('.table-sort').dataTable({
    });
    $(".table-sort tbody tr").dblclick(function (){
        var text = $(this).children('.text-with').html()
        var textWithout = $(this).children('.text-without').html()
        var id = $(this).children('.text_id').html()
        var index = layer.open({
            type: 2,
            title: '文本编辑',
            content: 'text-edit.php?id='+id+'&text='+text+'&textWithout='+textWithout
        });
        layer.full(index);
    });
    /*图片-查看*/
    function edit(ele){
        var id = $(ele).siblings('.text_id').html();
        var text = $(ele).siblings('.text-with').html();
        var textWithout = $(ele).siblings('.text-without').html();
        var index = layer.open({
            type: 2,
            title: '文本编辑',
            content: 'text-edit.php?id='+id+'&text='+text+'&textWithout='+textWithout
        });
        layer.full(index);
    }
</script>
</body>
</html>