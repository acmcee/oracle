<?php
header("Content_Type:application/json;charset=utf-8");
ini_set("error_reporting","E_ALL & ~E_NOTICE");
include './../body/connmysql.php';
$DBID=$_POST["DBID"];

if (!isset($DBID)||empty($DBID)){
    $search_result = '{"success":"false","errormes":"Parameter is wrong!,Please  Search DB ID First"}';
    echo $search_result;
}
else {
    //$sql="select * from `oracle` where id='".$keyword."'";
    //echo $sex;
    $exist_sql="select *  from `oracle` where ID='".$DBID."'";

    $exist_result=mysqli_query($con,$exist_sql);
    if (mysqli_num_rows($exist_result)==0){
        $search_result = '{"success":"false","errormes":"Cant\'t Check Database Id! "}';
        echo $search_result;
    }else {
        While($max_it=mysqli_fetch_array($max_result,MYSQLI_ASSOC)){
            $max_num=$max_it["max_num"];
        }
        $delete_sql="delete from  `oracle` where ID='".$DBID."'";
        //echo $insert_sql;
        if (mysqli_query($con,$delete_sql)){
            $search_result = '{
                "success": "true",
                "errormes":"delete successfully!"
            }';
             echo $search_result;
         }else {
            $search_result = '{"success":"false","errormes":"delete failed!'.mysqli_error().'"}';
            echo $search_result;
           
        }
    }    
}
mysqli_close($con);
?>