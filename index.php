<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1ArrayArrayArray/xhtml">
<head>
<title>oracle数据库列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Description" content="oracle 列表" />
<link type="text/css" rel="stylesheet" href="style.css"/> 
</head>
<body>

<!-- 输出系统等级-->

<div id='butt'>
<input type='button' value='所有' onclick="javascript:window.location.href='index.php?category=所有'">
<input type='button' value='核心系统' onclick="javascript:window.location.href='index.php?category=核心系统'">
<input type='button' value='重要系统' onclick="javascript:window.location.href='index.php?category=重要系统'">
<input type='button' value='一般系统' onclick="javascript:window.location.href='index.php?category=一般系统'">
<input type='button' value='准发布' onclick="javascript:window.location.href='index.php?category=准发布'">
<input type='button' value='容灾' onclick="javascript:window.location.href='index.php?category=容灾'">
<input type='button' value='BC' onclick="javascript:window.location.href='index.php?category=BC'">
</div>
</br>

<div>
    <form>
    ip or vip: 
    <input type="text" name="ip" />
    &nbsp
    主机名: 
    <input type="text" name="host" />
    <input id="chaxun" type='submit' value='查询'>
</form>
</div>
<div>
<?php
$con = mysqli_connect( "192.168.56.102","root","root","oracle_list");
$page=isset($_GET['page'])?intval($_GET['page']):1; 
$category=isset($_GET['category'])?$_GET['category']:"所有"; 
$ip=isset($_GET['ip'])?$_GET['ip']:""; 
$host=isset($_GET['host'])?$_GET['host']:""; 
//这句就是获取page中的值，假如不存在page，那么页数就是1。
$num=30;         //每页显示30条数据
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
   
if (!mysqli_query($con,'SET NAMES UTF8')){echo "UTF-8 set failed"."<br />";} 


$offset=($page-1)*$num; 
//获取limit的第一个参数的值 offset ，
//假如第一页则为(1-1)*10=0,第二页为(2-1)*10=10。(传入的页数-1) * 每页的数据 得到limit第一个参数的值 
if (($ip=="") && ($host=="")) {
       
        if($category == "所有"){
        $total=mysqli_num_rows(mysqli_query($con,"select 1 from `oracle`"));
        echo "<h1>oracle数据库主机总量是：".$total."</h1>";
        
        $pagenum=ceil($total/$num);      //获得总页数 pagenum
        
        if($page>$pagenum || $page == 0){
        echo "Error : Can Not Found The page .<br />";
        exit;
        }
        
        $info=mysqli_query($con,"select * from `oracle` limit $offset,$num ");   //获取相应页数所需要显示的数据
        echo "<hr>";
        echo "<table border=0 cellspacing=10 >";
        echo  "<tr><th>ID</th><th>系统域</th><th>系统等级</th><th>数据库名</th><th>TNS(4A)</th><th>TNS(OLD)</th>
        <th>主机名</th><th>IP</th><th>VIP</th><th>域名</th></tr>";
        While($it=mysqli_fetch_array($info,MYSQLI_ASSOC)){
            echo "<tr><td>".$it["ID"]."</td><td>".$it["sys_domain"]."</td><td>".$it["sys_level"]."</td><td>".$it["desc"]."</td><td>".$it["TNS"]."</td><td>".$it["OLDTNS"]."</td><td>".$it["hostname"]."</td><td>".$it["ip"]."</td><td>".$it["vip"]."</td><td>".$it["domain"]."</td></tr>";
        }  
        echo "</table>";
        echo "<hr>";
        echo "<div id= \"con\">";
        For($i=1;$i<=$pagenum;$i++){
            echo "<div class = \"fenye\">";
            $show=($i!=$page)?"<a href='index.php?page=".$i."'>$i</a>":"<b>$i</b>";
            echo $show."</div>";
        }
        echo "</div>";
    }
    else {
        $total=mysqli_num_rows(mysqli_query($con,"select 1 from `oracle` where sys_level like '%".$category."%'"));
        echo "<h1>oracle".$category."数据库主机总量是：".$total."</h1>";
        $pagenum=ceil($total/$num);      //获得总页数 pagenum
        
        if($page>$pagenum || $page == 0){
        echo "Error : Can Not Found The page .<br />";
        exit;
        }
        echo "<hr>";
        $info=mysqli_query($con,"select * from `oracle` where sys_level like '%".$category."%' limit $offset,$num "); 
        echo "<table border=0 cellspacing=10 >";
        echo  "<tr><th>ID</th><th>系统域</th><th>数据库名</th><th>TNS(4A)</th><th>TNS(OLD)</th>
        <th>主机名</th><th>IP</th><th>VIP</th><th>域名</th></tr>";
        While($it=mysqli_fetch_array($info,MYSQLI_ASSOC)){
            echo "<tr><td>".$it["ID"]."</td><td>".$it["sys_domain"]."</td><td>".$it["desc"]."</td><td>".$it["TNS"]."</td><td>".$it["OLDTNS"]."</td><td>".$it["hostname"]."</td><td>".$it["ip"]."</td><td>".$it["vip"]."</td><td>".$it["domain"]."</td></tr>";
        }  
        echo "</table>";
        echo "<hr>";
        echo "<div id= \"con\">";
        for($i=1;$i<=$pagenum;$i++){
            echo "<div class = \"fenye\">";
            $show=($i!=$page)?"<a href='index.php?page=".$i."&category=$category'>$i</a>":"<b>$i</b>";
            echo $show."</div>";
        }
        echo "</div>";
    }
}
else {

    if ($host!=""){
        $total=mysqli_num_rows(mysqli_query($con,"select 1 from `oracle` where hostname like '%".$host."%';"));
        $info=mysqli_query($con,"select * from `oracle`  where hostname like '%".$host."%' limit $offset,$num ;"); 
        if ($ip!=""){
            $total=mysqli_num_rows(mysqli_query($con,"select 1 from `oracle` where hostname like '%".$host."%' 
                and (ip like '%".$ip."%' or vip like '%".$ip."%');"));
            $info=mysqli_query($con,"select * from `oracle` where hostname like '%".$host."%' 
                and (ip like '%".$ip."%' or vip like '%".$ip."%' )limit $offset,$num ;");
                }
    }
    else {
        $total=mysqli_num_rows(mysqli_query($con,"select 1 from `oracle` where `ip` like '%".$ip."%' or `vip` like '%".$ip."%';"));
        $info=mysqli_query($con,"select * from `oracle` where `ip` like '%".$ip."%' or vip like '%".$ip."%' limit $offset,$num;");
    }
    $pagenum=ceil($total/$num); 
    //获取总页数
    if($page>$pagenum || $page == 0){
        echo "Error : Can Not Found The page .<br />";
        exit;
        }
    echo "<hr>";

    echo "<table border=0 cellspacing=10 >";
    echo  "<tr><th>ID</th><th>系统域</th><th>数据库名</th><th>TNS(4A)</th><th>TNS(OLD)</th>
    <th>主机名</th><th>IP</th><th>VIP</th><th>域名</th></tr>";
    While($it=mysqli_fetch_array($info,MYSQLI_ASSOC)){
        echo "<tr><td>".$it["ID"]."</td><td>".$it["sys_domain"]."</td><td>".$it["desc"]."</td><td>".$it["TNS"]."</td><td>".$it["OLDTNS"]."</td><td>".$it["hostname"]."</td><td>".$it["ip"]."</td><td>".$it["vip"]."</td><td>".$it["domain"]."</td></tr>";
    }  
    echo "</table>";
    echo "<hr>";
    echo "<div id= \"con\">";
    for($i=1;$i<=$pagenum;$i++){
        echo "<div class = \"fenye\">";
        $show=($i!=$page)?"<a href='index.php?page=".$i."&ip=$ip&host=$host'>$i</a>":"<b>$i</b>";
        echo $show."</div>";
    }
    echo "</div>";
    
}


/*显示分页信息，假如是当页则显示粗体的数字，其余的页数则为超连接，假如当前为第三页则显示如下*/
mysqli_close($con);
?>
<div>
<div id="foot">
<p>©CopyRight 2016-2016 example.com  All Rights Reserved. 测试也有版权，请尊重</p>
</div>

</body></html>