<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/12/29
 * Time: 9:40
 */
require_once '../mysql.php';
$type = $_GET['type'];
$value = $_GET['value'];
$sql = $mysqli->query("select * from state_info where ename='$type' and state_name like '$value%' and is_deleted=0");
$datarow = mysqli_num_rows($sql); //长度
if($datarow>0){
    $arr['code']=1;
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
} else {
    $arr['code']=0;
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
}