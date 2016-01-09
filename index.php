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

$total=mysqli_num_rows(mysqli_query("select * from `table`"));
echo "total num is $total"



?>