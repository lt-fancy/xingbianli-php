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
    <title>商品分类列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 商品分类列表 <a id="refresh" class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel(0)" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6dc;</i> 批量上线</a> <a href="javascript:;" onclick="datadel(1)" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6de;</i> 批量下线</a> <a class="btn btn-primary radius" data-title="添加商品分类" data-href="article-add.html" onclick="add_news()" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加商品分类</a></div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th hidden="hidden">id</th>
                <th hidden="hidden">isOn</th>
                <th width="80">分类id</th>
                <th width="100">分类名称</th>
                <th width="120">更新时间</th>
                <th width="60">上线状态</th>
                <th width="60">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once '../mysql.php';
            $sql = $mysqli->query("select * from state_info where ename='goods_category' order by gmt_modified desc");
            $datarow = mysqli_num_rows($sql); //长度
            //循环遍历出数据表中的数据
            for($i=0;$i<$datarow;$i++){
                $sql_arr = mysqli_fetch_assoc($sql);
                $id = $sql_arr['id'];
                $dictId = $sql_arr['state_id'];
                $dictName = $sql_arr['state_name'];
                $online = $sql_arr['is_deleted'];
                $time = $sql_arr['gmt_modified'];
                $isOn = '';
                if(0==$online){
                    $isOn= "<td class='td-status'><span class='label label-success radius'>已上线</span></td>";
                    $operate="<td class='f-14 td-manage'><a style='text-decoration:none' onClick='online(this.parentNode,1)' href='javascript:;' title='下线'><i class='Hui-iconfont' style='font-size: large'>&#xe6de;</i></a>
                                    </td>";
                } else{
                    $isOn = "<td class='td-status'><span class='label label-danger radius'>已下线</span></td>";
                    $operate="<td class='f-14 td-manage'><a style='text-decoration:none' onClick='online(this.parentNode,0)' href='javascript:;' title='上线'><i class='Hui-iconfont' style='font-size: large'>&#xe6dc;</i></a>
                                    </td>";
                }
                echo "<tr class='text-c'>
                                <td><input type='checkbox' value='$id' name=''></td>
                                <td class='list_id' hidden='hidden'>$id</td>
                                <td class='is_on' hidden='hidden'>$online</td>
                                <td>$dictId</td>
                                <td class='editable-cname'>$dictName</td>
                                <td>$time</td>
                                ",$isOn,$operate,"
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
    $(window).load(function () {
        $("#refresh").click();
    });
    var oTable = $('.table-sort').dataTable({

    });
    $('.editable-cname', oTable.fnGetNodes()).editable('../base/categorySave.php', {

        "callback": function (sValue, y) {

            var aPos = oTable.fnGetPosition( this );

            oTable.fnUpdate( sValue, aPos[0], aPos[1]);

        },

        "submitdata": function (value, settings) {

            var name = $(this).val();

            var id = $(this).siblings('.list_id').html();

            return {

                "name":name,

                "id": id

            };//这里你编辑的内容默认以“value”发送到后台

        },

        "height": "20px",

        "width": "120px"

    });
    function datadel(type) {
        var vals = [];
        $('input:checkbox:checked').each(function (index, item) {
            var value = $(this).val();
            if (value > 0) {
                vals.push($(this).val());
            }
        });
        var text = '';
        if(0==type){
            text = '确定要上线这';
        } else {
            text = '确定要下线这';
        }
        if (vals.length < 1) {
            layer.msg('请选择至少一行数据', {
                icon: 2,
                time: 1500
            });
        } else {
            var ids = vals.join(',');
            commonOnline(text + vals.length + '个商品分类吗？',ids,type);
        }
    }
    function online(ele,type) {
        var id = $(ele).siblings('.list_id').html();
        var msg='';
        if(0==type){
            msg = '确定要上线吗？';
        } else {
            msg = '确定要下线吗？'
        }
        commonOnline(msg,id,type);
    }
    function commonOnline(msg,id,type){
        layer.confirm(msg,function(index) {
            $.ajax({
                type: "POST",
                url: "../base/tagOnline.php",
                dataType: "json",
                data: {"id": id, "type": type},
                success: function (json) {
                    if (json.success == 1) {
                        layer.msg(json.msg, {
                            icon: 1,
                            time: 1500
                        },function () {
                            window.location.href = $("#refresh").attr('href');
                        });
                    } else {
                        layer.msg(json.msg, {
                            icon: 2,
                            time: 1500
                        },function () {
                            window.location.href = $("#refresh").attr('href');
                        });
                    }
                }
            });
        });
    }
    function add_news() {
        var index = layer.open({
            type: 2,
            area: ['500px','300px'],
            title: '添加商品分类',
            content: 'category-edit.php'
        });
    }
</script>
</body>
</html>