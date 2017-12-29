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
    <![endif]-->
    <title>订单详情</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户管理 <span class="c-gray en">&gt;</span> 订单详情 <a id="refresh" class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
            <tr class="text-c">
                <th hidden="hidden">id</th>
                <th width="80">订单号</th>
                <th width="100">商品名称</th>
                <th width="100">手机号</th>
                <th width="100">货架编号</th>
                <th width="40">已购数量</th>
                <th width="40">购买价格</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once '../mysql.php';
            $orderId = $_GET['id'];
            $uuid = $_GET['uuid'];
            $sql = $mysqli->query("select a.*,b.goods_name from order_details a LEFT JOIN goods_info b on a.goods_id=b.id where a.order_id=$orderId");
            $datarow = mysqli_num_rows($sql); //长度
            //循环遍历出数据表中的数据
            for($i=0;$i<$datarow;$i++){
                $sql_arr = mysqli_fetch_assoc($sql);
                $id = $sql_arr['id'];
                $name = $sql_arr['goods_name'];
                $number = $sql_arr['goods_number'];
                $price = $sql_arr['price'];
                $phone = $sql_arr['phone'];
                $rack = $sql_arr['rack_uuid'];
                echo "<tr class='text-c'>
                                <td class='order_id' hidden='hidden'>$id</td>
                                <td>$uuid</td>
                                <td>$name</td>
                                <td>$phone</td>
                                <td>$rack</td>
                                <td>$number</td>
                                <td>$price</td>
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
<script type="text/javascript" src="../lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    var oTable = $('.table-sort').dataTable({

    });
</script>
</body>
</html>