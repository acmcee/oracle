<?php
header("Content_Type:application/json;charset=utf-8");
ini_set("error_reporting","E_ALL & ~E_NOTICE");
include './../body/connmysql.php';
$keyword=$_GET["keyword"];
if (!isset($keyword) ||empty($keyword)) {
    $search_result = '{"success":"false","errormes":"Please Input DB ID First"}';
    echo $search_result;
}
else {
    $sql="select * from `oracle` where id='".$keyword."'";
    $result=mysqli_query($con,$sql);
    if (mysqli_num_rows($result)==0){
        $search_result = '{"success":"false","errormes":"Cant\'t find this Database ID! Please Check! "}';
        echo $search_result;
    }else {
        While($it=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $search_result = '{
                "success": "true",
                "errormes":"",
                "DBID": "'.$it["ID"].'",
                "sys_domain": "'.$it["sys_domain"].'",
                "sys_level": "'.$it["sys_level"].'",
                "desc": "'.$it["desc"].'",
                "TNS": "'.$it["TNS"].'",
                "OLDTNS": "'.$it["OLDTNS"].'",
                "hostname": "'.$it["hostname"].'",
                "ip": "'.$it["ip"].'",
                "vip": "'.$it["vip"].'",
                "domain": "'.$it["domain"].'"
            }';
            echo $search_result;
        }
    }
}
mysqli_close($con);
?>