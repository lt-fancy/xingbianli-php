<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/10/11
 * Time: 12:32
 */
require_once 'mysql.php';
session_start();
$old = md5(stripslashes(trim($_POST['old'])));
$new = md5(stripslashes(trim($_POST['new'])));
$confirm = md5(stripslashes(trim($_POST['confirm'])));
if($old==$new){
    $arr['msg'] = '新密码不能与原密码相同';
    $arr['success'] = 0;
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
    exit;
}
if($new!=$confirm){
    $arr['msg'] = '两次密码不一致';
    $arr['success'] = 0;
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
    exit;
}
$query = $mysqli->query("select * from shifang_user where password='$old'");

$us = is_array($row = mysqli_fetch_array($query));

$ps = $us ? $old == $row['password'] : FALSE;
if ($ps) {
    $mysqli->query("update shifang_user set password='$new' where password='$old'");
    $rs = true;
    if (mysqli_affected_rows($mysqli)) {
        $arr['success'] = 1;
        $arr['msg'] = '修改密码成功！';
    } else {
        $arr['success'] = 0;
        $arr['msg'] = '修改密码失败';
    }
} else {
    $arr['success'] = 0;
    $arr['msg'] = '原密码错误！';
}
echo json_encode($arr,JSON_UNESCAPED_UNICODE); //输出json数据