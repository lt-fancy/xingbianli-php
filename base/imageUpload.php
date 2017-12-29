<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/10/13
 * Time: 15:42
 */
// 允许上传的图片后缀
$allowedExts = array("gif", "jpeg", "jpg", "png");
$fileName= $_FILES["file"]["name"];
$temp = explode(".", $fileName);
$extension = end($temp);     // 获取文件后缀名
$flag1= ($_FILES["file"]["type"] == "image/gif")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/jpg")
    || ($_FILES["file"]["type"] == "image/pjpeg")
    || ($_FILES["file"]["type"] == "image/x-png")
    || ($_FILES["file"]["type"] == "image/png");
$flag2=$_FILES["file"]["size"] > 409600;
$flag3 = in_array($extension, $allowedExts);
if(!$flag1){
    $arr['msg'] = '文件格式不支持，请上传图片';
    $arr['success'] = 0;
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
    exit;
}
//if($flag2){
//    $arr['msg'] = '请上传大小在400KB以下的图片';
//    $arr['success'] = 0;
//    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
//    exit;
//}
if(!$flag3){
    $arr['msg'] = '只允许文件后缀名为gif,jpeg,jpg,png格式';
    $arr['success'] = 0;
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
    exit;
}
//// 判断当期目录下的 upload 目录是否存在该文件
//// 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
$dir = "../../images/";
if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}
if (file_exists($dir . $_FILES["file"]["name"])) {
    $arr['msg'] = $fileName.'文件已经存在';
    $arr['success'] = 0;
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
    exit;
} else {
    // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
    $serverFileName = time().'.'.$extension;
//    move_uploaded_file($_FILES["file"]["tmp_name"], $dir . $serverFileName);
    move_uploaded_file($_FILES["file"]["tmp_name"], $dir.$fileName);

    $arr['msg'] = $serverFileName;
    $arr['success'] = 1;
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
}