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
    $search_result = '{"success":"false","errormes":"Parameter is wrong!,Please Search DB ID First"}';
    echo $search_result;
}elseif (!isset($sys_domain) ||empty($sys_domain)) {
    $search_result = '{"success":"false","errormes":"请填写系统域!"}';
    echo $search_result;
}elseif (!isset($sys_level) ||empty($sys_level)) {
    $search_result = '{"success":"false","errormes":"请填写系统等级!"}';
    echo $search_result;
}elseif (!isset($desc) ||empty($desc)) {
    $search_result = '{"success":"false","errormes":"请填写数据库名!"}';
    echo $search_result;
}elseif ( (!isset($TNS) ||empty($TNS))&& (!isset($OLDTNS) ||empty($OLDTNS))) {
    $search_result = '{"success":"false","errormes":"请填写TNS名!"}';
    echo $search_result;
}elseif (!isset($hostname) ||empty($hostname)) {
    $search_result = '{"success":"false","errormes":"请填写主机名!"}';
    echo $search_result;
}elseif ( (!isset($ip) ||empty($ip))&& (!isset($vip) ||empty($vip))) {
    $search_result = '{"success":"false","errormes":"请填写IP!"}';
    echo $search_result;
}
else {
    //$sql="select * from `oracle` where id='".$keyword."'";
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