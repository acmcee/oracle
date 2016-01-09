<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1ArrayArrayArray/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Description" content="测试乱码" />

<style type="text/css">
div#butt input {
    margin: 10px 0 0 10px;
    background: red;
    color: #fff;
    width: 150px;
    height: 30px;
    font: 14px Verdana, Arial, Helvetica, sans-serif;
}</style>
</head>

<body>
<?php
$con = mysqli_connect( "192.168.56.102","root","root","oracle_list");
$page=isset($_GET['page'])?intval($_GET['page']):1; 
$category=isset($_GET['category'])?$_GET['category']:"无"; 
//这句就是获取page=18中的page的值，假如不存在page，那么页数就是1。
$num=30;         //每页显示10条数据
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
   
if (!mysqli_query($con,'SET NAMES UTF8')){echo "UTF-8 set failed"."<br />";} 

$offset=($page-1)*$num; 
//获取limit的第一个参数的值 offset ，
//假如第一页则为(1-1)*10=0,第二页为(2-1)*10=10。(传入的页数-1) * 每页的数据 得到limit第一个参数的值 

//输出系统分类

echo "<div id='butt'><input type='button' value='所有' onclick=\"javascript:window.location.href='index.php?category=所有';\">";
echo "<div id='butt'><input type='button' value='核心系统' onclick=\"javascript:window.location.href='index.php?category=核心系统';\">";
echo "<div id='butt'><input type='button' value='重要系统' onclick=\"javascript:window.location.href='index.php?category=重要系统';\">";
echo "<div id='butt'><input type='button' value='一般系统' onclick=\"javascript:window.location.href='index.php?category=一般系统';\">";
echo "<div id='butt'><input type='button' value='准发布' onclick=\"javascript:window.location.href='index.php?category=准发布';\">";
echo "<div id='butt'><input type='button' value='容灾' onclick=\"javascript:window.location.href='index.php?category=容灾';\">";
echo "<div id='butt'><input type='button' value='BC' onclick=\"javascript:window.location.href='index.php?category=BC';\"></div>";
echo "<br/>";

If($category == "所有"){
    $total=mysqli_num_rows(mysqli_query($con,"select 1 from `oracle`"));
    echo "<h1>oracle数据库主机总量是：".$total."</h1><br/>";
    $pagenum=ceil($total/$num);      //获得总页数 pagenum
    
    If($page>$pagenum || $page == 0){
       Echo "Error : Can Not Found The page .<br />";
       Exit;
    }
    
    $info=mysqli_query($con,"select * from `oracle` limit $offset,$num ");   //获取相应页数所需要显示的数据
    echo "<table border=0 cellspacing=10 >";
    echo  "<tr><th>ID</th><th>sys_domain</th>
    <th>system</th><th>system_level</th></tr>";
    While($it=mysqli_fetch_array($info,MYSQLI_NUM)){
        echo "<tr><td>".$it[0]."</td><td>".$it[1]."</td><td>".$it[3]."</td><td>".$it[4]."</td><td>".$it[5]."</td><td>".$it[6]."</td></tr>";
    }  
    echo "</table>";
    
    For($i=1;$i<=$pagenum;$i++){
        $show=($i!=$page)?"<a href='index.php?page=".$i."'>$i</a>":"<b>$i</b>";
        echo $show." ";
    }
}
else {
    $total=mysqli_num_rows(mysqli_query($con,"select 1 from `oracle` where sys_level like '%".$category."%'"));
    echo "<h1>oracle".$category."数据库主机总量是：".$total."</h1><br />";
    $pagenum=ceil($total/$num);      //获得总页数 pagenum
    
    If($page>$pagenum || $page == 0){
       Echo "Error : Can Not Found The page .<br />";
       Exit;
    }
    
    $info=mysqli_query($con,"select * from `oracle` where sys_level like '%".$category."%' limit $offset,$num "); 
    echo "<table border=0 cellspacing=10 >";
    echo  "<tr><th>ID</th><th>sys_domain</th>
    <th>system</th><th>系统等级</th>
    <th>数据库名</th> <th>TNS(4A)</th>
    </tr>";
    While($it=mysqli_fetch_array($info,MYSQLI_NUM)){
        echo "<tr><td>".$it[0]."</td><td>".$it[1]."</td><td>".$it[3]."</td><td>".$it[4]."</td><td>".$it[6]."</td><td>".$it[7]."</td></tr>";
    }  
    echo "</table>";
    
    For($i=1;$i<=$pagenum;$i++){
        $show=($i!=$page)?"<a href='index.php?page=".$i."&category=$category'>$i</a>":"<b>$i</b>";
        echo $show." ";
    }
    
}

/*显示分页信息，假如是当页则显示粗体的数字，其余的页数则为超连接，假如当前为第三页则显示如下
1 2 3 4 5 6
*/
mysqli_close($con);
?>

</body></html>