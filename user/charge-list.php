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
<title>充值记录列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户管理 <span class="c-gray en">&gt;</span> 充值记录列表 <a id="refresh" class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
				<tr class="text-c">
					<th hidden="hidden">id</th>
					<th width="80">手机号</th>
                    <th width="100">充值金额</th>
					<th width="40">充值方式</th>
					<th width="40">送的金额</th>
					<th width="40">充值时间</th>
				</tr>
			</thead>
			<tbody>
                <?php
                    require_once '../mysql.php';
                    $sql = $mysqli->query("select * from charge_record_info order by charge_time desc");
                    $datarow = mysqli_num_rows($sql); //长度
                    //循环遍历出数据表中的数据
                    for($i=0;$i<$datarow;$i++){
                        $sql_arr = mysqli_fetch_assoc($sql);
                        $phone = $sql_arr['phone'];
                        $id = $sql_arr['id'];
                        $chargeAmount = $sql_arr['charge_amount'];
                        $chargeMethod = $sql_arr['charge_method']==0?'支付宝':'微信';
                        $bonusAmount = $sql_arr['bonus_amount'];
                        $chargeTime = $sql_arr['charge_time'];
                        echo "<tr class='text-c'>
                                <td class='charge_record_id' hidden='hidden'>$id</td>
                                <td class='text-l'><a class=\"maincolor\" href=\"javascript:;\" onClick=\"showUserInfo(this)\">$phone</a></td>
                                <td>$chargeAmount</td>
                                <td>$chargeMethod</td>
                                <td>$bonusAmount</td>
                                <td>$chargeTime</td>
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
                        area: ['500px','300px'],
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
</script>
</body>
</html>