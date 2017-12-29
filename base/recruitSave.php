<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/10/14
 * Time: 15:10
 */
require_once '../mysql.php';
$id = $_POST['id'];
$title = $_POST['title'];
$department = $_POST['department'];
$content = $_POST['content'];
if($id==0){
    //新增
    $sql= $mysqli->query("insert into recruit_info (menu_ename,menu_cname,recruit_title,recruit_department,recruit_content,gmt_created,
                    gmt_modified,is_deleted) values('recruit_list','招聘信息','$title','$department','$content',now(),now(),0)");
} else {
    //更新
    $sql = $mysqli->query("update recruit_info set recruit_title='$title',recruit_department='$department',recruit_content='$content', gmt_modified=now() where id=$id");
}
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