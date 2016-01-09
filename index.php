<?php
$con = mysqli_connect( "192.168.56.102","root","root","oracle_list");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
else 
{
    echo "success";
    
}    

$total=mysql_num_rows(mysql_query("select * from `table`"));
echo "total num is $total"



?>