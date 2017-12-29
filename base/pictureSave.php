<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/10/16
 * Time: 11:53
 */
require_once '../mysql.php';
$id = $_POST['id'];
$content = $_POST['content'];
$sql = $mysqli->query("update image_info set image_uri='$content',gmt_modified=now() where id=$id");
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