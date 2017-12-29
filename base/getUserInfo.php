<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/12/29
 * Time: 9:40
 */
require_once '../mysql.php';
$phone = $_GET['phone'];
$sql = $mysqli->query("select * from user_info where phone='$phone'");
$datarow = mysqli_num_rows($sql); //长度
if($datarow=1){
    $sql_arr = mysqli_fetch_assoc($sql);
    $arr['code']=1;
    $arr['weixin']=$sql_arr['openid'];
    $arr['alipay']=$sql_arr['alipayid'];
    $arr['balance']=$sql_arr['balance'];
    $arr['time']=$sql_arr['gmt_created'];
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
}