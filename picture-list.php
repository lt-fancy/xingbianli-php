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
<title>图片列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 图片管理 <span class="c-gray en">&gt;</span> 图片列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
<!--	<div class="text-c">所属菜单-->
<!--        <span class="select-box inline">-->
<!--        <select name="" class="select">-->
<!--            <option value="0">全部分类</option>-->
<!--            <option value="1">分类一</option>-->
<!--            <option value="2">分类二</option>-->
<!--        </select></span>-->
<!--		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜图片</button>-->
<!--	</div>-->
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th hidden="hidden">ID</th>
					<th hidden="hidden">ename</th>
					<th width="100">所属菜单</th>
					<th width="100">所属父级菜单</th>
					<th width="100">图片封面</th>
					<th>图片名称</th>
					<th>是否父级菜单背景图</th>
					<th width="150">更新时间</th>
				</tr>
			</thead>
			<tbody>
            <?php
                require_once 'mysql.php';
                $sql = $mysqli->query("select * from image_info order by is_deleted asc,is_background asc");
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
                    $image=$sql_arr['image_uri'];
                    $imageName=$sql_arr['image_title'];
                    $isBack=$sql_arr['is_background']==0?'是':'否';
                    $time=$sql_arr['gmt_modified'];
                    $isOn=$sql_arr['is_deleted'];
                    echo "<tr class='text-c'>
                            <td class='image_id' hidden='hidden'>$id</td>
                            <td class='ename' hidden='hidden'>$ename</td>
                            <td class='cname'>$cname</td>
                            <td>$parentName</td>
                            <td><a href='javascript:;' onClick='picture_show(this.parentNode)'><img width='210' class='picture-thumb' src='../../images/$image'></a></td>
                            <td>$imageName</td>
                            <td>$isBack</td>
                            <td>$time</td>
                    ";
                }
            ?>
<!--				<tr class="text-c">-->
<!--					<td>001</td>-->
<!--					<td>分类名称</td>-->
<!--					<td><a href="javascript:;" onClick="picture_edit('图库编辑','picture-show.html','10001')"><img width="210" class="picture-thumb" src="temp/200x150.jpg"></a></td>-->
<!--					<td class="text-l"><a class="maincolor" href="javascript:;" onClick="picture_edit('图库编辑','picture-show.html','10001')">现代简约 白色 餐厅</a></td>-->
<!--					<td class="text-c">标签</td>-->
<!--					<td>2014-6-11 11:11:42</td>-->
<!--					<td class="td-status"><span class="label label-success radius">已发布</span></td>-->
<!--					<td class="td-manage"><a style="text-decoration:none" onClick="picture_stop(this,'10001')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a> <a style="text-decoration:none" class="ml-5" onClick="picture_edit('图库编辑','picture-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>-->
<!--				</tr>-->
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
//	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
//	"bStateSave": true,//状态保存
//	"aoColumnDefs": [
//	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
//	  {"orderable":false,"aTargets":[0,8]}// 制定列不参与排序
//	]
});
/*图片-查看*/
function picture_show(ele){
    var title = $(ele).siblings('.cname').html();
    var ename = $(ele).siblings('.ename').html();
    var index = layer.open({
        type: 2,
        title: title,
        content: 'picture-show.php?title='+title+'&ename='+ename
    });
    layer.full(index);
}
</script>
</body>
</html>