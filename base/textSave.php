<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/10/14
 * Time: 15:10
 */
require_once '../mysql.php';
$id = $_POST['id'];
$text = $_POST['text'];
$textWithout = $_POST['text-without'];
$sql = $mysqli->query("update text_info set text='$text',text_without='$textWithout',gmt_modified=now() where id=$id");
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