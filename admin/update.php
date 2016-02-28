<?php
header("Content_Type:application/json;charset=utf-8");
ini_set("error_reporting","E_ALL & ~E_NOTICE");
include './../body/connmysql.php';
$DBID=$_POST["DBID"];
$sys_domain=$_POST["sys_domain"];
$sys_level=$_POST["sys_level"];
$desc=$_POST["desc"];
$TNS=$_POST["TNS"];
$OLDTNS=$_POST["OLDTNS"];
$hostname=$_POST["hostname"];
$ip=$_POST["ip"];
$vip=$_POST["vip"];
$domain=$_POST["domain"];
if (!isset($DBID) ||empty($DBID)) {
    $search_result = '{"success":"false","errormes":"parameter is wrong!"}';
    echo $search_result;
}
else {
    $sql="select * from `oracle` where id='".$keyword."'";
    //echo $sex;
    $update_sql="update `oracle` set `sys_domain`='".$sys_domain."',`sys_level`='".$sys_level."',`desc`='".$desc. "' 
    ,`TNS`='".$TNS."',`OLDTNS`='".$OLDTNS."',`hostname`='".$hostname."'
    ,`ip`='".$ip."',`vip`='".$vip."',`domain`='".$domain."'
    where `ID`='".$DBID."'";
    //echo $update_sql;
    $result=mysqli_query($con,$update_sql);
    if (!$result){
        $search_result = '{"success":"false","errormes":"update failed!'.mysqli_error().'"}';
        echo $search_result;
    }else {
            $search_result = '{
                "success": "true",
                "errormes":"update successfully!"
            }';
            echo $search_result;
        }
}
mysqli_close($con);
?>