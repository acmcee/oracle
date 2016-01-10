<?php 
echo "<div style=\"margin-left:50px;margin-top:40px\">";
echo "<h1>DIR..</h1>";
$hostdir=dirname(__FILE__);
//获取本文件目录的文件夹地址
$filesnames = scandir($hostdir);
//获取也就是扫描文件夹内的文件及文件夹名存入数组 $filesnames
//print_r ($filesnames);

foreach ($filesnames as $name) {
//echo $name; 
$url=$name;
$aurl= "<a href=\"".$url."\">".$url."</a>";
if (substr($name,-3)!="php"){echo $aurl . "<br/>";}
}
echo "</div>";
?>