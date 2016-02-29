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
if (!empty($DBID)){
    $search_result = '{"success":"false","errormes":"Parameter is wrong!,Please Don\'t Search DB ID"}';
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
    $max_sql="select max(id)+1 max_num from `oracle`";

    $max_result=mysqli_query($con,$max_sql);
    if (mysqli_num_rows($max_result)==0){
        $search_result = '{"success":"false","errormes":"Cant\'t Check Max Number! "}';
        echo $search_result;
    }else {
        While($max_it=mysqli_fetch_array($max_result,MYSQLI_ASSOC)){
            $max_num=$max_it["max_num"];
        }
        $insert_sql="insert into  `oracle`(ID,sys_domain,sys_level,`desc`,TNS,OLDTNS,hostname,ip,vip,domain)  values ('". $max_num."','". $sys_domain."','". $sys_level."','". $desc."','". $TNS."','". $OLDTNS."','". $hostname."','". $ip."','". $vip."','". $domain."')";
        //echo $insert_sql;
        if (mysqli_query($con,$insert_sql)){
            $search_result = '{
                "success": "true",
                "errormes":"insert successfully!"
            }';
             echo $search_result;
         }else {
            $search_result = '{"success":"false","errormes":"insert failed!'.mysqli_error().'"}';
            echo $search_result;
           
        }
    }


}
mysqli_close($con);
?>