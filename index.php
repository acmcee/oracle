<?php
$con = mysql_connect("192.168.56.102","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

// some code

?>