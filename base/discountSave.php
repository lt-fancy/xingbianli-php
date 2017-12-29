<?php

/**

 * Created by PhpStorm.

 * User: User

 * Date: 2017/10/12

 * Time: 10:11

 */

require_once '../mysql.php';

$name=$_POST['value'];
$discount=$_POST['discount'];
$id=$_POST['id'];
if($id==0){
    $sql = $mysqli->query("select * from state_info where ename='random_discount' and state_name like '$discount%' and is_deleted=0");
    $datarow = mysqli_num_rows($sql); //长度
    if($datarow>0){
        $arr['success']=2;
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);
    } else {
        $sql1 = $mysqli->query("select max(state_id) total from state_info where ename='random_discount'");
        $sql_arr = mysqli_fetch_assoc($sql1);
        $max = $sql_arr['total'];
        $mysqli->query("insert into state_info(ename,cname,state_id,state_name,is_deleted,gmt_created,gmt_modified) values(
'random_discount','随机折扣',$max+1,'$name',0,now(),now())");
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
    }
} else{
    $mysqli->query("update state_info set state_name='$name' where id=$id");

    echo $name;
}
