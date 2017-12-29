<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/10/14
 * Time: 16:50
 */
require_once '../mysql.php';
$id = $_POST['ename'];
$content = $_POST['content'];
$sql = $mysqli->query("update common_info set content='$content',gmt_modified=now() where common_ename='$id'");
if(mysqli_affected_rows($mysqli)){
    $arr['success'] = 1;
    $arr['msg'] = '保存成功！';
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
} else {
    $arr['success'] = 0;
    $arr['msg'] = '保存失败！';
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
    exit;
}