<?php

/**

 * Created by PhpStorm.

 * User: User

 * Date: 2017/10/12

 * Time: 10:11

 */

require_once '../mysql.php';

$name=$_POST['value'];

$id=$_POST['id'];
if($id==0){
    $sql = $mysqli->query("select max(state_id) total from state_info where ename='charge_amount'");
    $sql_arr = mysqli_fetch_assoc($sql);
    $max = $sql_arr['total'];
    $mysqli->query("insert into state_info(ename,cname,state_id,state_name,is_deleted,gmt_created,gmt_modified) values(
'charge_amount','充值送的金额',$max+1,'$name',0,now(),now())");
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
} else{
    $mysqli->query("update state_info set state_name='$name' where id=$id");

    echo $name;
}
