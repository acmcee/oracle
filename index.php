<?php
$con = mysqli_connect( 
 "192.168.56.102", /* The host to connect to 连接MySQL地址 */   
 "root",   /* The user to connect as 连接MySQL用户名 */   
 "root", /* The password to use 连接MySQL密码 */   
 "oracle_list");  /* The default database to query 连接数据库名称*/   

if (mysqli_connect_errno($con))
  {
  die('Could not connect: ' . mysql_error());
  }

// some code
$conn->close();  

?>