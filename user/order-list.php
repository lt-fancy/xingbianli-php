﻿<?PHP
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
<title>订单列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户管理 <span class="c-gray en">&gt;</span> 订单列表 <a id="refresh" class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
				<tr class="text-c">
					<th hidden="hidden">id</th>
					<th width="80">订单号</th>
                    <th width="100">手机号</th>
					<th width="40">货架编号</th>
					<th width="40">商品总价</th>
					<th width="40">结算价格</th>
					<th width="80">优惠价格</th>
					<th width="40">随机折扣</th>
					<th width="40">微信订单号</th>
					<th width="120">支付宝订单号</th>
					<th width="120">订单状态</th>
					<th width="120">下单时间</th>
					<th width="120">支付时间</th>
				</tr>
			</thead>
			<tbody>
                <?php
                    require_once '../mysql.php';
                    $sql = $mysqli->query("select * from order_info order by gmt_created desc");
                    $datarow = mysqli_num_rows($sql); //长度
                    //循环遍历出数据表中的数据
                    for($i=0;$i<$datarow;$i++){
                        $sql_arr = mysqli_fetch_assoc($sql);
                        $id = $sql_arr['id'];
                        $orderId = $sql_arr['order_id'];
                        $phone = $sql_arr['phone_number'];
                        $rack = $sql_arr['rack_uuid'];
                        $total = $sql_arr['goods_total_price'];
                        $settle = $sql_arr['goods_settle_price'];
                        $benefit = $sql_arr['benefit_price'];
                        $random = $sql_arr['random_benefit_price'];
                        $weixinId = $sql_arr['weixin_order_id'];
                        $alipayId = $sql_arr['alipay_order_id'];
                        $state = $sql_arr['order_state']==0?'未支付':'已支付';
                        $createTime = $sql_arr['gmt_created'];
                        $payTime = $sql_arr['gmt_modified'];
                        echo "<tr class='text-c'>
                                <td name='orderId' class='order_id' hidden='hidden'>$id</td>
                                <td class='text-l'><a name='orderUUId' value='$id' class=\"maincolor\" href=\"javascript:;\" onClick=\"showOrderDetails()\">$orderId</a></td>
                                <td class='text-l'><a class=\"maincolor\" href=\"javascript:;\" onClick=\"showUserInfo(this)\">$phone</a></td>
                                <td class='text-l'><a class=\"maincolor\" href=\"javascript:;\" onClick=\"showRackInfo(this)\">$rack</a></td>
                                <td>$total</td>
                                <td>$settle</td>
                                <td>$benefit</td>
                                <td>$random</td>
                                <td>$weixinId</td>
                                <td>$alipayId</td>
                                <td>$state</td>
                                <td>$createTime</td>
                                <td>$payTime</td>
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
    function showOrderDetails() {
        var ele = $("a[name='orderUUId']");
        var id = $("td[name='orderId']").html();
        var uuid = $(ele).html();
        console.log(id+","+uuid);
        var index = layer.open({
            type: 2,
            title: '订单详情',
            content: 'order-details.php?id='+id+'&uuid='+uuid
        });
        layer.full(index);
    }
    function showUserInfo(ele) {
        var phone = $(ele).html();
        $.ajax({
            type: "GET",
            url: "../base/getUserInfo.php",
            dataType: "json",
            data: {"phone": phone},
            success: function (json) {
                if (json.code == 1) {
                    layer.open({
                        type: 1,
                        area: ['600px','400px'],
                        fix: false, //不固定
                        maxmin: true,
                        shade:0.4,
                        title: '查看用户信息',
                        content: "<table class='table table-border table-bordered table-bg mt-20'><thead><tr><th colspan='2' scope='col'>用户信息</th></tr></thead><tbody>" +
                        "<tr><td>手机号</td><td>"+phone+"</td></tr>" +
                        "<tr><td>微信openid</td><td>"+json.weixin+"</td></tr>" +
                        "<tr><td>支付宝id</td><td>"+json.alipay+"</td></tr>" +
                        "<tr><td>余额</td><td>"+json.balance+"</td></tr>" +
                        "<tr><td>注册时间</td><td>"+json.time+"</td></tr></tbody></table>"
                    });
                }
            }
        });
    }
    function showRackInfo(ele) {
        var uuid = $(ele).html();
        $.ajax({
            type: "GET",
            url: "../base/getRackInfo.php",
            dataType: "json",
            data: {"uuid": uuid},
            success: function (json) {
                if (json.code == 1) {
                    layer.open({
                        type: 1,
                        area: ['600px','400px'],
                        fix: false, //不固定
                        maxmin: true,
                        shade:0.4,
                        title: '查看货架信息',
                        content: "<table class='table table-border table-bordered table-bg mt-20'><thead><tr><th colspan='2' scope='col'>货架信息</th></tr></thead><tbody>" +
                        "<tr><td>货架编号</td><td>"+uuid+"</td></tr>" +
                        "<tr><td>货架名称</td><td>"+json.name+"</td></tr>" +
                        "<tr><td>货架地址</td><td>"+json.address+"</td></tr>" +
                        "<tr><td>业务员</td><td>"+json.biz+"</td></tr>" +
                        "<tr><td>补货员</td><td>"+json.replenish+"</td></tr>" +
                        "<tr><td>上线状态</td><td>"+json.state+"</td></tr>" +
                        "<tr><td>更新时间</td><td>"+json.time+"</td></tr></tbody></table>"
                    });
                }
            }
        });
    }
</script>
</body>
</html>