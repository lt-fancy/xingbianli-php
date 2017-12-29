<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/12/29
 * Time: 9:40
 */
require_once '../mysql.php';
$uuid = $_GET['uuid'];
$sql = $mysqli->query("select a.*,b.biz_man_name,c.replenishman_name from rack_info a
LEFT JOIN biz_man_info b on a.bizman_id=b.id
LEFT JOIN replenishman_info c on a.replenishman_id=c.id
where a.uuid='$uuid'
and b.is_deleted=0 and c.is_deleted=0");
$datarow = mysqli_num_rows($sql); //长度
if($datarow=1){
    $sql_arr = mysqli_fetch_assoc($sql);
    $arr['code']=1;
    $arr['biz']=$sql_arr['biz_man_name'];
    $arr['replenish']=$sql_arr['replenishman_name'];
    $arr['name']=$sql_arr['rack_name'];
    $arr['address']=$sql_arr['rack_address'];
    $arr['state']=$sql_arr['is_deleted']==0?'已上线':'已下线';
    $arr['time']=$sql_arr['gmt_created'];
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
}