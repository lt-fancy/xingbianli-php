<?PHP
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
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="../lib/html5shiv.js"></script>
    <script type="text/javascript" src="../lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="../static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="../static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="../lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="../static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="../static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="../lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>字典列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 字典管理 <span class="c-gray en">&gt;</span> 字典列表 <a id="refresh" class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th hidden="hidden">id</th>
                <th hidden="hidden">isOn</th>
                <th width="80">英文名称</th>
                <th width="100">中文名称</th>
                <th width="40">字典值</th>
                <th width="40">字典说明</th>
                <th width="120">更新时间</th>
                <th width="60">上线状态</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once '../mysql.php';
            $sql = $mysqli->query("select * from state_info order by gmt_modified desc");
            $datarow = mysqli_num_rows($sql); //长度
            //循环遍历出数据表中的数据
            for($i=0;$i<$datarow;$i++){
                $sql_arr = mysqli_fetch_assoc($sql);
                $id = $sql_arr['id'];
                $ename = $sql_arr['ename'];
                $cname = $sql_arr['cname'];
                $dictId = $sql_arr['state_id'];
                $dictName = $sql_arr['state_name'];
                $online = $sql_arr['is_deleted'];
                $time = $sql_arr['gmt_modified'];
                $isOn = '';
                if(0==$online){
                    $isOn= "<td class='td-status'><span class='label label-success radius'>已上线</span></td>";
                } else{
                    $isOn = "<td class='td-status'><span class='label label-danger radius'>已下线</span></td>";
                }
                echo "<tr class='text-c'>
                                <td><input type='checkbox' value='$id' name=''></td>
                                <td class='list_id' hidden='hidden'>$id</td>
                                <td class='is_on' hidden='hidden'>$online</td>
                                <td>$ename</td>
                                <td>$cname</td>
                                <td>$dictId</td>
                                <td>$dictName</td>
                                <td>$time</td>
                                ",$isOn,"
                            </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="../lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="../lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="../static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="../static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="../lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="../lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../lib/datatables/jquery.jeditable.js"></script>
<script type="text/javascript" src="../lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    var oTable = $('.table-sort').dataTable({

    });
</script>
</body>
</html>