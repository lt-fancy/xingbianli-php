<?php
/**
 * Created by PhpStorm.
 * User: sawallianc
 * Date: 2017/9/28 0028
 * Time: 11:59
 */
session_start();
$user = stripslashes(trim($_POST['account']));
$pass = MD5(stripslashes(trim($_POST['password'])));
$checkcode = stripslashes(trim($_POST['checkcode']));
if($_SESSION['checkcode']!=$checkcode){
    $arr['msg'] = '验证码错误';
    $arr['success'] = 0;
    echo json_encode($arr);
    exit;
}
$db = new mysqli();

//Connect to mysql
$db->connect("localhost", "root", "a8594588", "bianli");

$query = $db->query("select * from shifang_user where user_name='$user'");

$us = is_array($row = mysqli_fetch_array($query));

//$ps = $us ? $md5pass == $row['password'] : FALSE;

$ps = $us ? $pass == $row['password'] : FALSE;
if ($ps) {
    $rs = true;
    if ($rs) {
        $ip=$_SERVER['REMOTE_ADDR'];
        $time=date("Y-m-d H:i:s");
        $sql = $db->query("select count(*) as total from login_info");
        $sql_arr = mysqli_fetch_assoc($sql);
        $count=$sql_arr['total'];
        if($count<1){
            $sql1 = $db->query("insert into login_info(last_login_ip,login_count,last_login_time)values('$ip',1,'$time')");
        } else {
            $sql = $db->query("update login_info set last_login_ip='$ip',login_count=login_count+1,last_login_time='$time'");
        }
        $arr['success'] = 1;
        $arr['msg'] = '登录成功！';
        $_SESSION['isLogin']=1;
    } else {
        $arr['success'] = 0;
        $arr['msg'] = '登录失败';
    }
} else {
    $arr['success'] = 0;
    $arr['msg'] = '用户名或密码错误！';
}
echo json_encode($arr); //输出json数据
